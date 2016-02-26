<?php
namespace App\Http\Controllers\AppApi;

use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class PublicApiController extends Controller
{
    use Helpers;

    protected function respondForAuth($status, $code, $message, $token=null, $user=null){
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message,
            'token' => $token,
            'user' => $user
        ]);
    }

    protected function respondForAction($status, $code, $message="unable to perform action"){
        return response()->json([
            'status' => $status,
            'code' => $code,
            'message' => $message
        ]);
    }
}