<?php

namespace App\Http\Controllers\Crm\Workspace;
use App\Http\Controllers\Controller;
use Auth;

// internal models
use App\Models\Crm\Customer;
use App\Http\Resources\Crm\Customer\CustomerResource;
use App\Http\Resources\Crm\Customers\CustomersList as CustomersListResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;
// use Illuminate\Pagination\LengthAwarePaginator;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class PortfolioController extends Controller {
    protected $user;
    protected $status;
    protected $perPage;
    protected $byTasks;
    protected $count;
    protected $statusList = ['completed', 'planned', 'duedate'];
    public function __construct(Request $request)
    {
        if($this->middleware('auth')) {
            $this->user = $request->user()->counter;
        }
        $this->user = $request->user()->counter;
        $this->status =  $request->input('status') ? $request->input('status'): 'active';
        $this->perPage = $request->input('perPage') ? $request->input('perPage') : 50;
        $this->byTasks = $request->input('tasks') ? $request->input('tasks') : null;
        $this->count = $request->input('count') ? $request->input('count') : false;
    }

    public function index(){
        try {
            if($this->byTasks){
                $customersByTaskStatus = $this->_customerWithStatus($this->byTasks, $this->user);
                if($this->count) {
                    return  response()->json($customersByTaskStatus->count());
                }
                return new PortfolioCollection($customersByTaskStatus->attachTasks($this->byTasks, $this->user)->paginate($this->perPage));
            }
            $customers = Customer::owner($this->user)->list()->opened($this->user)->lastTask()->withoutTasks($this->user);
            if($this->count) {
                return response()->json($customers->count());
            }
            return new PortfolioCollection($customers->orderBy('priority', 'DESC')->paginate($this->perPage));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }


    protected  function _validateStatus($status){
        if(!in_array($status, $this->statusList)) {return false;}
        return true;
    }
    protected function _customerWithStatus($status, $user) {
        if($this->_validateStatus($status)){
            switch($status) {
                case $this->statusList[0]: // completed
                    return Customer::owner($user)->list()->orderBy('priority', 'DESC')->lastTask()->closed($user);
                default:
                    return Customer::owner($user)->list()->orderBy('priority', 'DESC')->lastTask()->opened($user)->taskByStatus($status, $user);
            }
        }
    }

}



