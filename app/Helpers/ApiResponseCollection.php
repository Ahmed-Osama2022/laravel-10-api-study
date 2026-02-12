<?php

namespace App\Helpers;

class ApiResponseCollection
{
  public static function sendResponse($message = null, $result = null, $code = 201)
  {
    $response = [
      'status' => $code,
      'message' => $message,
      'data'    => $result,
      'count' => $result->count(),
    ];
    return response()->json($response, $code);
  }
}
