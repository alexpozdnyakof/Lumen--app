<?php

namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Models\Crm\CustomerGroup;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Customer as CustomerResource;





class CustomerController extends Controller {
    public function __construct()
    {

    }
    public function index(Request $request){
        try {
            $customers = Customer::paginate(15);
            return response()->json(Customer::paginate(2));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function create(Request $request){
            $manager = Customer::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);
            // TODO: create
    }
    public function findOne($id, Request $request){
        return response()->json(Customer::findOrFail($id));
    }
    public function updateOne($id, Request $request){
        // TODO: update
        return response()->json(Manager::findOrFail($id));
    }
    public function deleteOne($id, Request $request){
        // TODO: delete
        return response()->json(Manager::findOrFail($id));
    }
}



