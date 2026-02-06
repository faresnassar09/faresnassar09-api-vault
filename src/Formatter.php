<?php

namespace Faresnassar09\ApiRepository;

class Formatter{


    public function success($data = [], $message = "Success", $code = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data
        ], $code);
    }

    
    public function failed($message = "Error occurred", $code = 400)
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'data'    => null
        ], $code);
    }

}