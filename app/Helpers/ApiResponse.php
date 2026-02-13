<?php

namespace App\Helpers;

class ApiResponse
{
  public static function sendResponse($message = null, $result = null, $code = 200)
  {
    $response = [
      'status' => $code,
      'message' => $message,
      'data'    => $result,
    ];
    return response()->json($response, $code);
  }
}
