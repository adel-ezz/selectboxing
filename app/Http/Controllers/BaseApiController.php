<?php

namespace App\Http\Controllers;

trait BaseApiController
{
    function apiResponse($result = null, $message = '', $error = '', $code = 200)
    {

        //======To convert All null value to empty=====/////

        $response = [
            'status' => $code == 200 ? true : false,
            'code' => $code,
            'data' => $result,
            'message' => $message,
            'errors' => ['error' => [$error]] ?? '',
        ];
        return response()->json($response, $code, ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE);
    }

//    function sendError($error, $errorMessage = [], $code = 404)
//    {
//        $response = [
//            'success' => false,
//            'message' => $error
//        ];
//        if (!empty($errorMessage)) {
//            $response['date'] = $errorMessage;
//        }
//        return response()->json($response, $code);
//    }
}
