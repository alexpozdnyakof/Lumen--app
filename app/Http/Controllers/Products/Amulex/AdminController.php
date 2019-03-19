<?php

namespace App\Http\Controllers\Products\Amulex;
use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\Products\Amulex\Logger;
use App\Models\Products\Amulex\Certificate;
use App\Models\Products\Amulex\Activated;
use App\Models\Products\Amulex\Pay;
use App\Models\Products\Amulex\Seller;
use App\Http\Resources\Products\Amulex\Admin\Certificate as CertificateResource;
use App\Http\Resources\Products\Amulex\Admin\Payment as PaymenteResource;
use App\Http\Resources\Products\Amulex\Admin\Seller as SellerResource;
use App\Http\Resources\Products\Amulex\Admin\PaymentCollection;
use App\Models\Products\Amulex\AmulexSerial;



class AdminController extends Controller {
    public function __construct()
    {

    }

    public function index() {
        return CertificateResource::collection(Activated::all());
    }
    public function createPayment(Request $request) {
        $data = json_decode($request->input('data'));
        $payment = Pay::create(
            [
                'dtprov' => $data->dtprov,
                'comment' => $data->comment,
                'summ' => $data->summ,
                'purpose' => $data->purpose,
                'reason' => $data->reason,
                'payer_personalacc' => $data->payer_personalacc,
                'payer_bank_bic' => $data->payer_bank_bic,
                'payer_inn' => $data->payer_inn,
                'payer_name' => $data->payer_name,
                'status' => 'not found',
                //'cert_id' => $data->cert_id,
            ]);
        return response()->json($payment);
    }
    public function searchUser(Request $request) {
        Log::debug($request->input('keyword'));
        $keyword = $request->input('keyword');
        $keyword = "%{$keyword}%";
        Log::debug($keyword);
        return SellerResource::collection(Seller::whereLike(['ФИО', 'rb'], trim($request->input('keyword')))->limit(15)->get());
    }

    public function searchPayment(Request $request) {
        $keyword = $request->input('keyword');
        return PaymenteResource::collection(Pay::whereLike(['payer_inn', 'payer_name'], trim($request->input('keyword')))->orderBy('dtprov', 'desc')->limit(100)->get());
    }

    public function certificates() {
        //return Activated::with(['amulexcode', 'payment'])->get();
        return CertificateResource::collection(Activated::whereHas('amulexcode')->with(['amulexcode', 'payment', 'sellerprofile'])->get());
    }

    public function payments() {
        //return Pay::with(['activated'])->orderBy('amulex_memorder_id', 'ASC')->paginate(200);
        return PaymenteResource::collection(Pay::with(['activated'])->orderBy('amulex_memorder_id', 'ASC')->paginate(200));
    }
    protected function _isPaymentExist($certId) {
        return $payment = Pay::where('cert_id', $certId)->first();
    }
    protected function _clearPayment($payment) {
        if($payment) {
            $payment->cert_id = null;
            $payment->status = "not found";
            return $payment->save();
        }
    }

    public function getOnePayment($id) {
        return Pay::findOrFail($id);
    }

    public function paymentUpdate($id, Request $request) {

        if(!$id) { return response()->json('bad request', 400); }
        $data = json_decode($request->input('paydata'));

        $payment = Pay::findOrFail($id);

        $payment->cert_id = $data->successActivated;
        $payment->status = 'found';
        //$paymentDate = $payment->dtprov;
        $payment->save();
        /*
        $successUpdate = Activated::findOrFail($data->successActivated);
        $successUpdate->status = 1;
        $successUpdate->updated = $paymentDate;
        $successUpdate->save();
        if($data->dropActivated) {
            $dropUpdate = Activated::findOrFail($data->dropActivated);
            $dropUpdate->status = 2;
            $dropUpdate->updated = Carbon::now();
            $dropUpdate->save();
        }
        */
        return response()->json('Success', 201);
    }
    public function update($id, Request $request){
        $cell = json_decode($request->input('cell'));

        //return response()->json($cell->value);
        Activated::whereId($id)->update([$cell->column => $cell->newValue]);
        return $this->_makeLog(
            [
                'action' => 'Обновил',
                'field' => $cell->column,
                'entityName' => 'Сертификат',
                'entityId' => $id,
                'prevValue' => $cell->prevValue,
                'newValue' => $cell->newValue,
                'user' => '1234', // auth user
            ]
        );
    }


    protected function _decodeField($field){

    }

    protected function _makeLog($log) {
        return Logger::create(
            [
                'action' => $log['action'],
                'entityName' => $log['entityName'],
                'entityId' => $log['entityId'],
                'field' => $log['field'],
                'prevValue' => $log['prevValue'],
                'newValue' => $log['newValue'],
                'user' => $log['user'],
                'created' => Carbon::now()
            ]
        );
    }

}


