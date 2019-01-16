<?php
namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Task;
use App\Models\Crm\TaskType;
use App\Models\Crm\Customer;
use App\Models\Crm\Manager;
// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\Crm\Task\TaskResource;






class TaskController extends Controller {
    public function __construct()
    {

    }
    public function index($id, Request $request){
        try {
            $managerId = 2;
            return response()->json(Task::with(['type'])->where('client_id', $id)->get());
            return response()->json(Task::where('executor_uid', $id)->get());

            return response()->json(Manager::with(['tasks' => function($query) use ($managerId) {
                $query->where('executor_uid', $managerId);
            },])->get());

            return response()->json(Task::with(['type', 'manager', 'customer'])->findOrFail($id));
            //return response()->json(Task::with(['type, manager, customer'])->findOrFail($id));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function tasksUser($user = NULL, Request $request) {
        try {
            if( is_null($user) ) {
                $user = $request->user()->counter;
            }
            $tasks = Task::where('executor_uid', $user)->whereNull('act_id')->with([
                'customer' => function($q) {
                    $q->select('client_id', 'name', 'priority');
                },
                'author' => function($q) {
                    $q->select('counter', 'ФИО');
                },
            ])->orderBy('act_start_time', 'DESC')->get();
            return response()->json($this->_groupTasks($tasks));
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }

/*
    public function tasksCustomer($customerId, Request $request) {
        try {
            $tasks = Task::where('client_id', $customerId)->orderBy('act_start_time', 'DESC')->get();
            return response()->json($this->_groupTasks($tasks));
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }
*/

public function tasksCustomer($id, Request $request) {
    try {
        $tasks = Task::where('client_id', $id)->orderBy('act_start_time', 'DESC')->get();
        return response()->json($this->_groupTasks($tasks));
    } catch (Exception $e) {
        report($e);
        return $e;
    }
}


    public function tasksCustomer__backup($customerId, $managerId = NULL, Request $request) {
        try {
            if( is_null($managerId) ) {
                $managerId = $request->user()->counter;
            }
            $tasks = Task::where('client_id', $customerId)->orderBy('act_start_time', 'DESC')->get();
            return response()->json($this->_groupTasks($tasks));
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function customerWithTask($customerId, $managerId = NULL, Request $request) {
        try {
            if( is_null($managerId) ) {
                $managerId = $request->user()->counter;
            }
            return response()->json(Customer::with(['tasks' => function($query) {
                $query->orderBy('act_start_time', 'DESC');
            }])->get($customerId));
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    private function _groupTasks($tasks) {
        $progress = $tasks->filter(function($item, $key) {
            return $item->act_id == NULL;
        });

        $completed = $tasks->diff($progress);

        $duedate = $progress->filter(function($item, $key) {
            return Carbon::now()->greaterThan(Carbon::createFromTimestamp($item->act_start_time));
        });
        return [
            'duedate' => TaskResource::collection($duedate), 
            'planned' => TaskResource::collection($progress->diff($duedate)),
            'completed' => TaskResource::collection($completed),
        ];
        //ordered by asc
    }

    private function _compareDate($date) {
        return Carbon::now()->greaterThan(Carbon::createFromTimestamp($date));
    }

    public function tasksDev(Request $request) {
        return response()->json(Task::where('executor_uid', $request->user()->counter)->whereNull('act_id')->orderBy('act_start_time', 'DESC')->count());
    }

    // 1 где не налл акт айди и act_start_time прошло
    // 2 где не налл и act_start_time по убыванию
    // 3 где налл и act_start_time по убыванию

    // для кастомера сортируем по act_start_time в обратном порядке наверху последняя

    public function get(Request $request){
        try {
            $permissions = Permission::all()->get();
            return response()->json($permissions);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function findOne($id, Request $request){
        try {
            $permission = Permission::findOrFail($id);
            return response()->json($permission);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function create(Request $request) {
        try {
            $permission = Permission::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            ]);
            return  response()->json($permission);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

}



