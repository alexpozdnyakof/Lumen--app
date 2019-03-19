<?php

namespace App\Http\Controllers\Loans;
use App\Http\Controllers\Controller;

// internal models
use App\Models\Products\Loans\GrossCredit;
use App\Models\Products\Loans\GrossOverdraft;
use App\Models\Products\Loans\CalculateHistory;
use App\Models\Datatable\TableCell;

// internal extended
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;






class _CalculatorBaseController extends Controller {
    protected $futureDate;
    protected $lastDate;
    protected $prevDate;
    public function __construct(){
        $this->lastDate = $this->_checkAvailableDate();
        $this->futureDate = $this->_checkFutureDate();
        $this->prevDate = $this->_checkPreviousDate();
    }


    // ----- get ftp row using date values and config --------//
    protected function _getFtp($range, $isPrevious, $isOverdraft = false ) {
            $range = $range < 3 ? 3: $range;
            $range = $range > 60 && $range < 84 ? 84: $range;
            $range = $range > 84 ? 84: $range;
            if($isPrevious){
                //Log::debug($isPrevious)
                $row = TableCell::whereType(1)->whereValue($isOverdraft ? 'овердрафт' : $range)->where('created_at', $this->prevDate )->select('row')->take(1)->get();
            } else {
                $row = TableCell::whereType(1)->whereValue($isOverdraft ? 'овердрафт' : $range)->where('created_at', $this->lastDate )->select('row')->take(1)->get();
            }
            return  $this->_convertFtp($row[0]->row);
    }
    // ----- get overdraft grooss value --------//
    protected function _getCreditGross($range, $segment, $collateral, $amount) {
        $period = $this->_calculateRangePeriod($range, $segment);
        $row = GrossCredit::wherePeriod($period)->whereSegment($segment)->whereAmount($amount)->pluck($collateral)->all();
        return $row[0];
    }
    // ----- get overdraft grooss value --------//
    protected function _getOverdraftGross($segment, $collateral){
       $row = GrossOverdraft::whereSegment($segment)->pluck($collateral)->all();
       return $row[0];
    }
    // ----- get ftp value and make it more clearly --------//
    protected function _convertFtp($row){
        $ftp = TableCell::whereType(2)->whereRow($row)->select('value')->firstOrFail();
        $ftp = str_replace('%', '', $ftp['value']);
        $ftp = str_replace(',', '.', $ftp);
        return $ftp;
    }
    // -----  check last available date --------//
    protected function _calculateRangePeriod($range, $segment){
        $periodsForMicro = ['0-12', '12-36', '36-60'];
        $periodsForSmall = ['0-12', '12-36', '36-60', '64-84'];
        if($segment === 'small'){
            if($range <= 12){
                return $periodsForSmall[0];
            }
            if($range > 12 && $range <= 36){
                return $periodsForSmall[1];
            }
            if($range > 36 && $range <= 60){
                return $periodsForSmall[2];
            }
            if($range > 60){
                return $periodsForSmall[3];
            }
        }
        if($segment === 'micro'){
            if($range <= 12){
                return $periodsForMicro[0];
            }
            if($range > 12 && $range <= 36){
                return $periodsForMicro[1];
            }
            if($range > 36 && $range <= 60){
                return $periodsForMicro[2];
            }
            if($range > 60){
                return $periodsForMicro[2];
            }
        }
    }
    // -----  check last available date --------//
    protected function _checkAvailableDate(){
        $lastVersion = TableCell::whereType(1)->whereValue('34')->orderBy('created_at', 'desc')->select('created_at')->latest()->firstOrFail()->created_at;
        if($this->compareDates($lastVersion)) {
            return $lastVersion;
        } else {
            $skipLastVersion = TableCell::whereType(1)->orderBy('created_at', 'desc')->whereValue('34')->select('created_at')->skip(1)->take(1)->get();
            return $skipLastVersion[0]->created_at;
        }
    }
    // ----- check preLast available date --------//
    protected function _checkPreviousDate(){
        if($this->_checkFutureDate()) {
            $lastVersion = TableCell::whereType(1)->orderBy('created_at', 'desc')->whereValue('34')->select('created_at')->skip(2)->take(1)->get();
            return  $lastVersion[0]->created_at;
        } else {
            $lastVersion = TableCell::whereType(1)->orderBy('created_at', 'desc')->whereValue('34')->select('created_at')->skip(1)->take(1)->get();
            return  $lastVersion[0]->created_at;
        }
    }
    // ----- check if we have update scores --------//
    protected function _checkFutureDate(){
        $lastVersion = TableCell::whereType(1)->orderBy('created_at', 'desc')->whereValue('34')->select('created_at')->firstOrFail()->created_at;
        if(!$this->compareDates($lastVersion)) {
            return $lastVersion;
        } else {
            return null;
        }
    }
    // ----- check last update available date to know how much skipping --------//
    protected function compareDates($lastUpdateDate) {
        $now = new Carbon();
        $date = new Carbon($lastUpdateDate);
        return $now >= $date;
    }
}


