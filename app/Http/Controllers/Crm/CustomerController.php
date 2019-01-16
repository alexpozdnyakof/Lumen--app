<?php

namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Models\Crm\CustomerGroup;
use App\Http\Resources\Crm\Portfolio\PortfolioResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;
use App\Http\Resources\Crm\Customer\CustomerResource;

// use Illuminate\Pagination\LengthAwarePaginator;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class CustomerController extends Controller {
    public function __construct()
    {

    }

    public function get(Request $request){
        try {
            return response()->json(Customer::paginate(150));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function getOne($id, Request $request){
         //return response()->json(Customer::findOrFail($id));
        return response()->json(new CustomerResource(Customer::findOrFail($id)));
    }

    public function findOne($id, Request $request){
        try {
            $permission = Customer::findOrFail($id);
            return response()->json($permission);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function create(Request $request) {
        try {
            $customer = Customer::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            ]);
            return  response()->json($customer);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

}



