<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
  // Store a specific resource
  public function store(StoreMessageRequest $request)
  {
    $data = $request->validated();
    $record = Message::create($data);

    if ($record) {
      return ApiResponse::sendResponse('Message sent successfully', 201);
    }
  }
}
