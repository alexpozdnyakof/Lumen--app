<?php

namespace App\Http\Controllers\Loans;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Products\Loans\LoanScore;
use App\Models\Datatable\TableCell;
// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Loans\Calculator\Ranges as RangeResource;
use App\Http\Resources\Loans\Calculator\Keys as KeyResource;





class CalculatorController extends Controller {
    public function __construct(){ }
    // ----- get inital keys --------//
    public function keys() {
        return response()->json(KeyResource::collection(LoanScore::where('collateral', '!=', 'Opex')->orderBy('created_at', 'asc')->take(5)->get()));
    }
    // ----- get inital ranges --------//
    public function ranges(){
        return response()->json(RangeResource::collection(TableCell::whereType(1)->where('value', '!=', 'овердрафт')->take(59)->get()));
    }
    // ----- calculate score --------//
    public function calculate(Request $request) {
        $scores = LoanScore::whereCollateral($request->input('collateral'))->latest()->select($request->input('segment'))->firstOrFail();
        $opex = LoanScore::whereCollateral('Opex')->latest()->select($request->input('segment'))->firstOrFail();
        $row = TableCell::whereType(1)->whereValue($request->input('range'))->select('row')->latest()->firstOrFail();
        $cof = TableCell::whereType(2)->whereRow($row['row'])->select('value')->latest()->firstOrFail();
        $cof = str_replace('%', '', $cof['value']);
        $cof = str_replace(',', '.', $cof);
        $opex = str_replace(',', '.', $opex[$request->input('segment')]);
        $scores = str_replace(',', '.', $scores[$request->input('segment')]);
        $result = floatval($scores) * 100 + floatval($opex) * 100 + floatval($cof);
        return response()->json([
            'collateral' => $request->input('collateral'),
            'segment' => $request->input('segment'),
            'range' => $request->input('range'),
            'type' => $request->input('type'),
            'score' => round($result, 2)
        ]);
    }

}



