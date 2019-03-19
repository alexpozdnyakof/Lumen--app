<?php

namespace App\Http\Controllers\Open;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Http\Resources\Crm\Customer\CustomerResource;
use App\Http\Resources\Crm\Customer\CustomerOpen;
use App\Http\Resources\Crm\Customer\CustomerAnalytics;


// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;



/*
$router->group(['prefix' => 'customers'], function () use ($router) {
    $router->group(['prefix' => '{id:[0-9]+}'], function () use ($router) {
        $router->get('/', ['uses' => 'Crm\Workspace\CustomerController@index']); // [-] show customer main info +
        $router->get('/tasks', ['uses' => 'Crm\Workspace\TaskController@customer']); // [-] show customer tasks -
        $router->get('/analytics', ['uses' => 'Crm\Workspace\CustomerController@analytics']); // [-] show customer analytics +
        $router->get('/okved', ['uses' => 'Crm\Workspace\CustomerController@okvedCodes']); // [-] show customer okved -
        $router->put('/', ['uses' => 'Crm\Workspace\CustomerController@update']); // [-] update customer data -
    });
    $router->group(['prefix' => 'group'], function () use ($router) {
        $router->get('{id:[0-9]+}', ['uses' => 'Crm\Workspace\CustomerController@group']);
    });
});
*/


class CustomerController extends Controller {
    protected $user;
    protected $status;
    public function __construct(Request $request)
    {
        /*
        if($this->middleware('auth')) {
            $this->user = $request->user()->counter;
        }*/
        $this->status =  $request->input('status') ? $request->input('status'): 'active';
    }


    public function index(Request $request){
        try {
            return response()->json(Customer::paginate(100));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function show($id){
        try {
            return response()->json(new CustomerOpen(Customer::findOrFail($id)));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }



}



