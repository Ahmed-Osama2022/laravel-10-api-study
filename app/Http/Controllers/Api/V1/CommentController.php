<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CommentResource;
use App\Http\Resources\V1\PostCommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return ApiResponse::sendResponse('Comments retrieved successfully', CommentResource::collection(Comment::all()));
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
  public function show(Comment $comment)
  {
    if (!$comment) {
      return ApiResponse::sendResponse('No Comment found', [], 200);
    }

    return ApiResponse::sendResponse('Comment retrieved successfully', new CommentResource($comment));
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Comment $comment)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Comment $comment)
  {
    //
  }

  /**
   * Get the post by a comment
   */
  public function getPost(Comment $comment)
  {
    if (!$comment->post) {
      return ApiResponse::sendResponse('No Post founded for this Comment', [], 200);
    }

    return ApiResponse::sendResponse('Post retrieved successfully', new PostCommentResource($comment->post));
  }
}
