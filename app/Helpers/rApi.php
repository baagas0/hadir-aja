<?php

if (!function_exists('rApi')) {

    /**
     * description
     *
     * @param
     * @return
     */
    function rApi($status_code, $result, $message = '')
    {
        $response = [
            "success" => $status_code === 200 ? true : false,
            "message" => $message,
            "data" => $result,
        ];
 
        return response()->json($response, 200);
    }
}
