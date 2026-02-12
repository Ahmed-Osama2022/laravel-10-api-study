<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Helpers\ApiResponseCollection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
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

    return ApiResponseCollection::sendResponse('Comments retrieved successfully', $comments);
  }
}
