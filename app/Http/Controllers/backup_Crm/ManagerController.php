<?php
namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Models\Crm\CustomerGroup;
use App\Models\Crm\Manager;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Manager as ManagerResource;
use App\Http\Resources\CustomerGroup as GroupResource;



class ManagerController extends Controller {

    public function __construct()
    {

    }
    // return new UserExtendedResource(User::with(['roles','permissions'])->findOrFail($user->counter));
    //->mapToGroups(function ($item, $key) {
    // return [$item['glavnyi'] => array('username' => $item['ФИО'], 'id' => $item['counter'], 'count' => $item['clients_count'])];
    public function index(Request $request){
        try {
            $manager = Manager::all();
            return response()->json($request->get('teroffice'));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    // Maybe not need it
    public function create(Request $request){
            $manager = Manager::create([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);
            // TODO: create
    }
    public function findOne($id, Request $request){
        // $groups = new ManagerResource(Manager::with(['groups'])->find($id));
        $groups = Manager::with(['groups'])->find($id);
        $groupResults = [];
        $groupsMap = $groups->groups->mapToGroups(function ($item, $key) {
             return [$item->spisok_id =>  array('id' => $item->spisok_id, 'name' => $item->group->spisok_name, 'description' => $item->group->spisok_opisanie, 'valuation' => $item->group->spisok_ball)];
        });
        foreach($groupsMap as $group){
            Log::debug($group[0]['name']);
            Log::debug(count($group));
            $groupResults[] = ['id' => $group[0]['id'], 'name' => $group[0]['name'],  'description' => $group[0]['description'], 'valuation' => $group[0]['valuation'], 'count'=> count($group)];
        }

        return $groupResults;
    }
    public function updateOne($id, Request $request){
        // TODO: update
        return response()->json(Manager::findOrFail($id));
    }
    public function deleteOne($id, Request $request){
        // TODO: delete
        return response()->json(Manager::findOrFail($id));
    }

    public function assetClients(Request $request){
        for ($i = 4007122; $i <= 4007271; $i++) {
            $pivot = ManagerClientPivot::create([
                'client_id' => $i,
                'uid' => 2,
                'branch' => 0000,
                'is_active' => 1
            ]);
        };
        return response()->json('wellDone');
        // TODO: create
    }
}



