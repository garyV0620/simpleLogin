<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class BaseController extends Controller
{
    public function sendResponse($data, $message){
        $response = [
            "status" => true,
            "data"  => $data,
            "message"  => $message,
        ];

        return response()->json($response, 200);
    }

    public function sendError ($error, $errorMessages = [], $code = 404){
        $response = [
            'status' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response ['error'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
