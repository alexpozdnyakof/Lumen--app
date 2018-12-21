<?php

namespace App\Http\Controllers\Datatables;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Datatable\DataTable;
use App\Models\Datatable\TableRow;
use App\Models\Datatable\TableCell;
use App\Models\Datatable\TableColumn;
use App\Models\Datatable\TableChange;

//use League\Flysystem\Filesystem;

// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class DatatableController extends Controller {
    public function __construct()
    {

    }

    public function index(Request $request){
        try {
            $lastChange =  $this->getLastChange($request->input('table'));
            //return response()->json($lastChange->updated());
           return response()->json($this->getTable(intval($request->input('table'))));
        }
        catch (Exception $e) {
            report($e);
            return $e;
        }
    }
    public  function userdata(Request $request) {
        return response()->json($request->user());
    }
    private function getRows($table) {
        return true;
    }
    private function getLastChange($table){
        return TableCHange::whereDatatable($table)->orderBy('id','desc')->first();
    }
    private function getTable($id){
       // return TableColumn::with(['rows'  ])->whereId($id)
        return DataTable::with(['changes','columns', 'rows.cells'])->whereId($id)->firstOrFail();
        // ->orderBy('id', 'desc')
    }
    //protected $fillable = ['id','order', 'status', 'table', 'author', 'created_at', 'updated_at'];
    // protected $fillable = ['id','value', 'created_at', 'updated_at', 'type', 'row'];
    private function countRows($tableId){
        $table = DataTable::withCount('rows')->whereId($tableId)->firstOrFail();
        return $table->rows_count;
    }
    /*
    public function parseTable(Request $request){
        $count = $this->countRows(1);
        $dataRequest = $request->input('data');
        $data = json_decode($dataRequest);
        Log::debug('data');
        Log::debug(gettype($data));
        for($e = 0; $e < count($data); $e++){
            Log::debug($data);
            $row = TableRow::create([
                'table' => 1,
                'created_at' => Carbon::now()
            ]);
           // return response()->json($row->id);
            $cell = TableCell::create([
                'value' => $data[$e]->range,
                'created_at' => Carbon::now(),
                'type' => 1,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->rates->rub,
                'created_at' => Carbon::now(),
                'type' => 2,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->rates->eur,
                'created_at' => Carbon::now(),
                'type' => 3,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->rates->usd,
                'created_at' => Carbon::now(),
                'type' => 4,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->risk->rub,
                'created_at' => Carbon::now(),
                'type' => 5,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->risk->eur,
                'created_at' => Carbon::now(),
                'type' => 6,
                'row' =>  $row->id,
            ]);
            $cell = TableCell::create([
                'value' => $data[$e]->risk->usd,
                'created_at' => Carbon::now(),
                'type' => 7,
                'row' =>  $row->id,
            ]);
        }
        return response()->json($data);
    }
    */

    public function parseTable(Request $request){
        $count = $this->countRows(1);
        $dataRequest = $request->input('data');
        $data = json_decode($dataRequest);
        Log::debug('data');
        Log::debug(gettype($data));
        for($e = 0; $e < count($data); $e++){
            Log::debug($data);
           // return response()->json($row->id);
           $row = TableRow::create([
            'table' => 1,
            'created_at' => Carbon::now()
        ]);
       // return response()->json($row->id);
        $cell = TableCell::create([
            'value' => $data[$e]->range,
            'created_at' => Carbon::now(),
            'type' => 1,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->rates->rub,
            'created_at' => Carbon::now(),
            'type' => 2,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->rates->eur,
            'created_at' => Carbon::now(),
            'type' => 3,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->rates->usd,
            'created_at' => Carbon::now(),
            'type' => 4,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->risk->rub,
            'created_at' => Carbon::now(),
            'type' => 5,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->risk->eur,
            'created_at' => Carbon::now(),
            'type' => 6,
            'row' =>  $row->id,
        ]);
        $cell = TableCell::create([
            'value' => $data[$e]->risk->usd,
            'created_at' => Carbon::now(),
            'type' => 7,
            'row' =>  $row->id,
        ]);
        }
        return response()->json($data);
    }

}



