<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
