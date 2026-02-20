<?php

use App\Http\Controllers\Api\V1\AdController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\CommentControllerInvoke;
use App\Http\Controllers\Api\V1\MessageController;
use App\Http\Controllers\Api\V1\PostController;
use App\Http\Controllers\Api\V1\PostControllerInvoke;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//   return $request->user();
// });

Route::prefix('v1')->group(function () {
  // Route::get('/posts', PostController::class);
  // Route::get('/comments', CommentControllerInvoke::class);

  Route::apiResource('/posts', PostController::class);
  Route::apiResource('/comments', CommentController::class);

  // =================== For messages ===================
  Route::post('/messages', [MessageController::class, 'store']);


  // Get the post by a comment
  Route::get('/comments/{comment}/post', [CommentController::class, 'getPost']);


  /**
   * For ADS Module
   */
  Route::prefix('/ads')->group(function () {
    Route::apiResource('/', AdController::class);

    // Get ads based on domain API endpoint
    Route::get('/domain/{domain_id}', [AdController::class, 'getAdByDomain']);
    // Search the ads
    Route::get('/search', [AdController::class, 'search']);
  });


  /**
   * For Authentication
   */
  Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
  });
});
