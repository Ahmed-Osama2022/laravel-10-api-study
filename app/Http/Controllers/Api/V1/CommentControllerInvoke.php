<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Helpers\ApiResponseCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentControllerInvoke extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $comments = Comment::all();

    if ($comments->isEmpty()) {
      return ApiResponse::sendResponse('No posts found', [], 200);
    }

    return ApiResponseCollection::sendResponse('Comments retrieved successfully', CommentResource::collection($comments));
  }
}
