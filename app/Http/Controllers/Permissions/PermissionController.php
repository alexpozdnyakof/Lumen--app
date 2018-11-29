<?php

namespace App\Http\Controllers\Permissions;
use App\Http\Controllers\Controller;

// internal models
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class PermissionController extends Controller {
    public function __construct()
    {

    }

    public function index(Request $request){
        $user = $request->user();
        if(!$request->user() || !$user->can('loans/calculator/edit')){
            abort(404);
        }
        try {
            $permissions = Permission::all();
            return response()->json($permissions);
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



