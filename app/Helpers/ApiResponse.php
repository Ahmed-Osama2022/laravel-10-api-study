<?php

namespace App\Helpers;

class ApiResponse
{
  public static function sendResponse($code = 201, $message = null, $result = null)
  {
    $response = [
      'success' => true,
      'message' => $message,
      'data'    => $result,
    ];
    return response()->json($response, $code);
  }
}
