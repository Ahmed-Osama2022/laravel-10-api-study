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
   * Display a listing of the resource.
   */
  public function index()
  {
    $posts = Post::all();
    return ApiResponseCollection::sendResponse('Posts retrieved successfully', PostResource::collection($posts), 201);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Post $post)
  {
    // $posts = Post::();
    if (!$post) {
      return ApiResponse::sendResponse('Post not found', new PostResource($post), 201);
    }

    return ApiResponse::sendResponse('Post retrieved successfully', new PostResource($post), 201);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Post $post)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Post $post)
  {
    //
  }
}
