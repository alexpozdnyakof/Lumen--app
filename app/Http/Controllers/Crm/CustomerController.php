<?php

namespace App\Http\Controllers\Crm;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Crm\Customer;
use App\Models\Crm\CustomerGroup;
use App\Http\Resources\Crm\Portfolio\PortfolioResource;
use App\Http\Resources\Crm\Portfolio\PortfolioCollection;
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


/*
    'id' => $this->client_id,
    'valuation' => $this->priority,
    'bank' => json_encode(['pro' => $this->current_bank, 'payroll' => $this->current_payroll_bank]),
    'name' => $this->name,
    'industry' => $this->okved_vid_deyatelnosti,
    'activity' => json_encode(['last' => $this->posledniy_resultat_text, 'date' => $this->data_posledniy_contact_unixtime]),
    'groups' => $this->groups,
    'budget' => json_encode(['period' => $this->vyruchka_period, 'year' => $this->vyruchka_za_god])
*/
    public function index(Request $request){
        try {
        //return Customer::paginate(1);
         $customers = new PortfolioCollection(Customer::orderBy('priority', 'ASC')->paginate(150));
        //$customers = $customers->toArray();
       // return new PortfolioCollection($customers);
       //return gettype($customers['data']);
        //$collection = collect($customers->data);
        return $customers;
        return  new PortfolioCollection($collection);
        $portfolio = Customer::select(
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
        )->with(['managers'=>function($query){
                $query->select('counter');
                }, 'groups'=>function($query){
                $query->select('spisok_name');
            }]
        )->paginate(100)->toArray();
       // return $portfolio['data'];
        $prospects = collect($portfolio['data']);
        return $prospects;
        return response()->json([
            'data' => CustomersListResource::collection($prospects),
            'pages' => json_encode([
                'total' => $portfolio['total'],
                'current_page' => $portfolio['current_page']
            ])
        ]);
          //  return respone()->json(new CustomersListResource(Customer::get())
       // $customers = CustomersListResource::collection(Customer::paginate(100));
      /*  $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($customers);
        $perPage = 1;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
        */
       // $total = $customers->total();
        //$result = $customers->toArray();
        //return $result["total"];
       // return $customers->getCollection();
       //return response()->json(CustomersListResource::collection($result["data"]));
      /* return response()->json(CustomersListResource::collection($customers->getCollection())->additional([
            'meta' => [
                'total' => $total,
            ]
        ]));*/
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }

    public function get($id, Request $request){
        try {
            return response()->json(Customer::findOrFail($id));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
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



