<?php
namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Models\Crm\CustomerGroup;
use App\Models\Crm\Manager;
use App\Models\Crm\ManagerClientPivot;
use App\Models\Crm\CustomerGroupPivot;
use App\Http\Resources\Crm\Customers\CustomersList as CustomersListResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;
use Illuminate\Pagination\LengthAwarePaginator;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class ManagerController extends Controller {
    public function __construct() { }

    public function index(Request $request){
        try {
           if ($request->get('branch')) {
            return response()->json(Manager::whereBranch($request->get('branch'))->get());
           }
           // add v_shtate
           return response()->json(Manager::all());
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function findOne($id, Request $request){
        // $groups = new ManagerResource(Manager::with(['groups'])->find($id));
        if ($request->get('rb')) {
            return response()->json(Manager::whereRb($request->get('rb'))->findOrFail());
        }
        return response()->json(Manager::findOrFail($id));
    }

    public function groups(Request $request){
        try {
            $groups = Manager::with(['groups'])->findOrFail($request->user()->counter);
            $groupResults = [];
            $groupsMap = $groups->groups
            ->filter(function($item, $key) {
                return intval($item->group->business_id) === 1;
            })
            ->mapToGroups(function ($item, $key) {
                return [$item->spisok_id =>  array('id' => $item->spisok_id, 'name' => $item->group->spisok_name, 'description' => $item->group->spisok_opisanie, 'valuation' => $item->group->spisok_ball)];
            });
            foreach($groupsMap as $group){
                $groupResults[] = ['id' => $group[0]['id'], 'name' => $group[0]['name'],  'description' => $group[0]['description'], 'valuation' => intval($group[0]['valuation']), 'count'=> count($group)];
            }
            return $groupResults;
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function portfolio(Request $request) {
        $id = $request->user()->counter;
        return new PortfolioCollection(Customer::select(
            'client_id',
            'priority',
            'current_bank',
            'current_payroll_bank',
            'name',
            'okved_vid_deyatelnosti',
            'data_posledniy_contact_unixtime',
            'vyruchka_period',
            'vyruchka_za_god',
            'posledniy_resultat_text'
        )->whereHas('managers', function($q) use ($id) {
            $q->whereCounter($id);
        })->whereHas('managerPivot', function($q){
            $q->where('is_active', 1);
        })->orderBy('priority', 'DESC')->paginate(25));

    }

    public function customersInGroup($group, Request $request){
        try {
            $id = $request->user()->counter;
            return new PortfolioCollection(Customer::select(
                'client_id',
                'priority',
                'current_bank',
                'current_payroll_bank',
                'name',
                'okved_vid_deyatelnosti',
                'data_posledniy_contact_unixtime',
                'vyruchka_period',
                'vyruchka_za_god',
                'posledniy_resultat_text'
            )->whereHas('groups', function($q) use ($group) {
                $q->where('crm_spiski.spisok_id', $group);
            })->whereHas('managers', function($q) use ($id) {
                $q->whereCounter($id);
            })->whereHas('managerPivot', function($q){
                $q->where('is_active', 1);
            })->orderBy('priority', 'DESC')->paginate(100));
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
    // 7122
    // 7271
    //protected $fillable = ['spisok_id', 'client_id', 'add_uid', 'add_time', 'otrabotan_a_id'];

    public function assetGroups(Request $request){
        for ($i = 4007134; $i <= 4007271; $i++) {
            $pivot = CustomerGroupPivot::create([
                'spisok_id' => 129,
                'client_id' => $i,
            ]);
        };
        return response()->json('wellDone');
    }
    /* ----- use it snippet for mass reassignment  ------------
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
    }
    */

}



