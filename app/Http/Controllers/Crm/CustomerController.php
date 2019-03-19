<?php

namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Http\Resources\Crm\Customer\CustomerResource;
use App\Http\Resources\Crm\Customer\CustomerCompact;
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
    protected $status;
    public function __construct(Request $request)
    {
        $this->status =  $request->input('status') ? $request->input('status'): 'active';
    }

    // main info
    public function index($id){
        try {
            return response()->json(new CustomerCompact(Customer::findOrFail($id)));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    // analytics section
    public function analytics($id){
        try {
            return response()->json(new CustomerAnalytics(Customer::getAnalytics()->findOrFail($id)));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    // load okved codes info
    public function okvedCodes($id, Request $request){
        try {
            // return just okved with names
            // detach two types first three or all
            return response()->json(new CustomerResource(Customer::findOrFail($id)));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    // load attractionChannel
    public function attractionChannel($id, Request $request){
        if(!$id) { return response()->json('customer id except'); };
        try {
            // return just okved with names
            // detach two types first three or all
            return response()->json(new CustomerResource(Customer::findOrFail($id)));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }



    public function updateOne($id, Request $request){
        if(!$id) { return response()->json('customer id except'); };
        try {
            // return just okved with names
            // detach two types first three or all
            return response()->json('update  one');
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
}



