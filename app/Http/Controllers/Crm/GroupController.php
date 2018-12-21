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





class GroupController extends Controller {
    public function __construct()
    {

    }
    public function index(Request $request){
        try {
                   // return new UserExtendedResource(User::with(['roles','permissions'])->findOrFail($user->counter));

            $groups = CustomerGroup::with(['customers'])->findOrFail(636);
            return response()->json($groups);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
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



