<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
    /**
     * @var \Tymon\JWTAuth\JWTAuth
     */
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function authUser (Request $request)  {
        $ntlmhash = 'rb064144'; // simulated ntlm hash
        $login = $this->decodeHash($ntlmhash); // simulated ntlm hash decode
        if($login) { return $this->login($login); } // if decoded -> make auth
    }

    private function decodeHash($ntlmhash){
        if(!$ntlmhash) { return; }
        $ntlmSimulated = $ntlmhash;
        return $ntlmSimulated;
    }


    private function login($rb)
    {
        if(!$rb) { return; }

        try {
            if (! $token = $this->jwt->attempt(['rb' => $rb])) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], 500);

        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent' => $e->getMessage()], 500);

        }

        return response()->json(compact('token'));
    }
}