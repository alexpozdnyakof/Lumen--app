<?php
namespace App\Http\Controllers\Crm\Workspace;
use App\Http\Controllers\Controller;
use Auth;

// internal models
use App\Models\Crm\Experimental\Customer;
use App\Models\Crm\Experimental\Group;


use App\Http\Resources\Crm\Customers\CustomersList as CustomersListResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;


// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class EgroupController extends Controller {
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $group = Group::myCustomers('complete', $request->user()->counter)->countCustomers('complete', $request->user()->counter)->get();
        return response()->json($group);
    }
    // sortBy virtual field
    // $clients = Client::get()->sortBy('full_name'); // works!

    public function show($id, Request $request){
        try {
            $customers = customer::owner(2)->entryGroup(283)->count();
            return response()->json($customers);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

}



