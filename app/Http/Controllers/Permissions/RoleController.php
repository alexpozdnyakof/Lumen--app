<?php

namespace App\Http\Controllers\Permissions;
use App\Http\Controllers\Controller;

// internal models
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\PermissionRole;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class RoleController extends Controller {
    public function __construct()
    {

    }

    public function index(Request $request){
        try {
            $roles = Role::all();
            return response()->json($roles);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function get(Request $request){
        try {
            $roles = Role::all()->get();
            return response()->json($roles);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function findOne($id, Request $request){
        try {
            $role = Role::findOrFail($id);
            return response()->json($role);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function create(Request $request) {
        try {
            $role = Role::firstOrCreate([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            ]);
            $permissionsToAdd = array();
            $permissionsToRemove = array();
            $permissionsJson = json_decode($request->input('permissions'), true);
            foreach ($permissionsJson as $permission) {
                if($permission['action'] === 'add'){
                 $permissionsToAdd[] = ['permission_id'=> $permission['id'], 'role_id'=> $role->id];
                };
                if($permission['action'] === 'remove'){
                    $permissionsToRemove[] = ['permission_id'=> $permission['id'], 'role_id'=> $role->id];
                };
            }
            $permissionsroles = PermissionRole::insert($permissionsToAdd);
            Log::debug($permissionsToAdd);
            return response()->json($role);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

}



