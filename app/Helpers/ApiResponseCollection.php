<?php

namespace App\Helpers;

class ApiResponseCollection
{
  public static function sendResponse($message = null, $result = null, $code = 201)
  {
    $response = [
      'status' => $code,
      'message' => $message,
      'count' => $result->count(),
      'data'    => $result,
    ];
    return response()->json($response, $code);
  }
}
