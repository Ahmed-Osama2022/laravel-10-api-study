<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  /**
   * This function runs automatically when the Controller is called
   */
  public function __invoke()
  {
    $posts = Post::all();
    return $posts;
  }
}
