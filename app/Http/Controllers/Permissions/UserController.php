<?php

namespace App\Http\Controllers\Permissions;
use App\Http\Controllers\Controller;

// internal models
use App\Models\User\Permission;
use App\Models\User\Role;
use App\Models\User\PermissionRole;
use App\Models\User\PermissionUser;
use App\Models\User\RoleUser;
use App\Models\User\User;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserExtended as UserExtendedResource;

use App\Http\Resources\UserResource as UserResource;




class UserController extends Controller {
    public function __construct()
    {

    }

    public function currentUser(Request $request){
        $user = $request->user();
        return new UserResource(User::findOrFail($user->counter));
       // return new UserExtendedResource(User::with(['roles','permissions'])->findOrFail($user->counter));
       // return User::findOrFail($user->counter);
       //  $userWithData  = User::with(['roles','permissions'])->findOrFail($user->id);
        // return response()->json($user);
    }

    public function index(Request $request){
        try {
            $users = User::all();
            return response()->json($users);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function findOne($id, Request $request){
        try {
            $user = User::findOrFail($id);
            return response()->json($user);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public function create(Request $request) {
        try {
            Log::debug($request->input('name'));
            Log::debug($request->input('rb'));
            $user = User::firstOrCreate([
                'name' => $request->input('name'),
                'rb' => $request->input('rb'),
            ]);
            $permissionsToAdd = array();
            $rolesToAdd = array();
            $permissionsJson = json_decode($request->input('permissions'), true);
            $rolesJson = json_decode($request->input('roles'), true);
            foreach ($permissionsJson as $permission) {
                if($permission['action'] === 'add'){
                 $permissionsToAdd[] = ['permission_id'=> $permission['id'], 'user_id'=> $user->id];
                };
            }
            foreach ($rolesJson as $role) {
                if($role['action'] === 'add'){
                 $rolesToAdd[] = ['role_id'=> $role['id'], 'user_id'=> $user->id];
                };
            }
            $permissionsuser = PermissionUser::insert($permissionsToAdd);
            $rolesuser = RoleUser::insert($rolesToAdd);
            Log::debug($permissionsToAdd);
            return response()->json($user);
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

}



