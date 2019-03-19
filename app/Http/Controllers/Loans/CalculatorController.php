<?php

namespace App\Http\Controllers\Loans;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Loans\_CalculatorBaseController;

// internal models
use App\Models\Products\Loans\CalculateHistory;

use App\Models\Datatable\TableCell;
// internal extended
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;






class CalculatorController extends _CalculatorBaseController {

    public function __construct(){
        parent::__construct();
    }


    public function index(Request $request) {
       $config = json_decode($request->input('config'));
       if($config->type === 'overdraft') {
        $gross = $this->_getOverdraftGross($config->segment, $config->collateral);
       }
       if($config->type === 'credit') {
            $gross = $this->_getCreditGross($config->range, $config->segment, $config->collateral,  $config->amount);
       }
       $ftp = $this->_getFtp($config->range, $config->isPrevious, $isOverdraft = $config->type === 'overdraft' ? true : false);
        return response()->json(
            ['ftp' => $ftp, 'gross' => $gross]
        );
    }
    // ----- get update dates --------//
    public function latestScoreUpdate(){
        return response()->json(['lastVersion' => $this->lastDate, 'prevVersion' =>  $this->prevDate]);
    }
    // ----- save calculate result --------//
    public function saveResult(Request $request) {
        $result = json_decode($request->input('result'));
        $calculatorResult =  CalculateHistory::create(
            [
                'ftp' => $result->ftp,
                'gross' => $result->gross,
                'decent' => $result->decent,
                'result' => $result->result,
                'date' => Carbon::now(),
                'managerid' => $result->id,
                'type' => $result->type,
                'note' => $result->note,
                'managername' => $result->managerName
            ]
        );
        return response()->json($calculatorResult);
    }

    public function getCalculateHistory($id) {
        return response()->json(CalculateHistory::whereManagerid($id)->orderBy('date', 'desc')->get());
    }

    public function getOneCalculateHistory($id) {
        $data = CalculateHistory::findOrFail($id);
        return view('calculator', ['data'=>$data]);
    }
}



