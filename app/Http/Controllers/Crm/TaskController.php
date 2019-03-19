<?php
namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;
use Auth;

// internal models
use App\Models\Crm\Task;
// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Resources\Crm\Workspace\TaskResource;






class TaskController extends Controller {
    protected $user;
    protected $statusList = ['completed', 'planned', 'duedate'];
    protected $status;
    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->user = $request->user() ? $request->user()->counter : null;
        $this->status =  $request->input('status') ? $request->input('status'): null;
    }
    //---- Get tasks with params ----/
    public function index(Request $request){
        try {
            if($this->status) {
                $tasks = $this->_tasksWithStatus($this->status,  $this->user);
                return response()->json(TaskResource::collection($tasks->withCustomer()->type()->orderBy('act_start_time', 'DESC')->get()));
            }
            return response()->json($this->_allTasks($this->user));
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function customer($customerId){
        try {

            return TaskResource::collection(Task::hasCustomer($customerId)->orderBy('act_start_time', 'DESC')->get());
            // return taskowner collection
        } catch (Exception $e) {
            report($e);
            return $e;
        }
    }

// move it to parent task controller and make store action with result response
    public function store(Request $request){
        $task = json_decode($request->input('task'));
        return response()->json($task->customer);
        //['departure' => 'Oakland', 'destination' => 'San Diego'],
        // post request
        // create  task 
    }

    public function show($id){
        //return Task::listView()->findOrFail($id);
        return new TaskResource(Task::listView()->findOrFail($id));
        // move to  parent taskcontroller
        // findOne
        //return resource
        // post request
        // show one task 
    }

    public function update($id, Request $request){
        // completeOne
        // put request
        //only if 
    }
    public function destroy($id, Request $request){
        // completeOne
        // put request
    }


    protected function _allTasks($user) {
        $completed = $this->_tasksWithStatus($this->statusList[0], $user);
        $planned = $this->_tasksWithStatus($this->statusList[1], $user);
        $duedate = $this->_tasksWithStatus($this->statusList[2], $user);

        $allTasks=[
            'completed' => TaskResource::collection($completed->withCustomer()->type()->orderBy('act_start_time', 'DESC')->take(10)->get()),
            'planned' => TaskResource::collection($planned->withCustomer()->type()->orderBy('act_start_time', 'DESC')->get()),
            'duedate' => TaskResource::collection($duedate->withCustomer()->type()->orderBy('act_start_time', 'DESC')->get()),
        ];
        return $allTasks;
    }

    protected function _validateStatus($status){
        if(!in_array($status, $this->statusList)) {return;}
        return true;
    }

    protected function _tasksWithStatus($status, $user) {
        if(!$this->_validateStatus($status)){}
            return Task::owner($user)->status($status);
    }
}



