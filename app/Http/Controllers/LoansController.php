<?php

namespace App\Http\Controllers;

// internal models
use App\Models\LoanScore;
use App\Models\TableCell;
// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;





class LoansController extends Controller {
    public function __construct()
    {
            // группировать по дате и отдавать
    }

    public function index() {
        $scores = LoanScore::get()->mapToGroups(function ($item, $key) {
            return [$item['created_at'] => array('key' => $item['collateral'], 'micro' => $item['micro'], 'small' => $item['small'])];
        });
        $scoresDate = LoanScore::where('collateral', '!=', 'Opex')->orderBy('created_at', 'asc')->take(5)->select('id', 'collateral')->get();
       //$scoresDate = LoanScore::latest()->get();
       //$scoresDate = LoanScore::groupBy('created_at')->get();
        return response()->json($scoresDate);
    }

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
        return response()->json(round($result, 2));
    }

}



