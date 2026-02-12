<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Helpers\ApiResponseCollection;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  /**
   * This function runs automatically when the Controller is called
   */
  public function __invoke()
  {
    $posts = Post::all();
    // return $posts;

    // this for only one post ('One record')
    // return new PostResource($posts);

    // But for a collection of posts
    // return PostResource::collection($posts);

    // return ApiResponse::sendResponse('Posts retrieved', PostResource::collection($posts));
    return ApiResponseCollection::sendResponse('Posts retrieved', PostResource::collection($posts));
  }
}
