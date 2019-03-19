<?php
namespace App\Traits;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;

trait RestExceptionHandlerTrait {

	public function isLoggedIn() {
        if (! Auth::check()) {
            return response()->json('Access denied', 401);
        }
        return false;
	}

    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch(true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound();
                break;
            default:
                $retval = $this->badRequest();
        }

        return $retval;
    }





}
