<?php
namespace App\Http\Controllers\Crm\Workspace;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\Crm\CustomerGroup;
use App\Models\Crm\Customer;

use App\Http\Resources\Crm\Workspace\GroupResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;

// internal extended
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;



class GroupController extends Controller {
    protected $user;
    protected $status;
    protected $statusList = ['completed', 'planned', 'duedate'];
    public function __construct(Request $request)
    {
        $this->middleware('auth');  
        $this->user = $request->user()->counter;
        $this->status =  $request->input('status') ? $request->input('status'): 'planned';
    }

    public function index(){
        return GroupResource::collection(CustomerGroup::myCustomers($this->status,  $this->user)->countCustomers($this->status, $this->user)->get());
    }

    public function show($id){
        try {
            return new GroupResource(CustomerGroup::myCustomers($this->status,  $this->user)->countCustomers($this->status, $this->user)->findOrFail($id));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    /// show customers in group sorted by activity
    public function customers($id){
        try {
            //return new PortfolioCollection($customersByTaskStatus->attachTasks($this->byTasks, $this->user)->paginate($this->perPage));
            $customersInGroup = $this->_customerWithStatusInGroup($this->status, $this->user, $id);
            //return new PortfolioCollection( $customersInGroup->get());

            return new PortfolioCollection($customersInGroup->get());
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
    protected function _customerWithStatusInGroup($status, $user, $group) {
        if($this->_validateStatus($status)){
            switch($status) {
                case $this->statusList[0]: // completed
                    return Customer::owner($user)->entryGroup($group)->list()->orderBy('priority', 'DESC')->lastTask()->closed($user);
                default:
                    return Customer::owner($user)->entryGroup($group)->list()->orderBy('priority', 'DESC')->lastTask()->opened($user);
            }
        }
    }
}

