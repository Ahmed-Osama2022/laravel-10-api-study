<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $ads = Ad::latest()->paginate(10);
    if (count($ads) > 0) {
      // Check if there is paginaion pagess
      if ($ads->total() > $ads->perPage()) {
        $data = [
          'paginationLinks' => [
            'currentPage' => $ads->currentPage(),
            'perPage' => $ads->perPage(),
            'total' => $ads->total(),
            'links' => [
              'first' => $ads->url(1),
              'previous' => $ads->previousPageUrl(),
              'next' => $ads->nextPageUrl(),
              'last' => $ads->url($ads->lastPage())
            ]
          ],
          'records' => AdResource::collection($ads),
        ];
      } else {
        $data =  AdResource::collection($ads);
      }
      return ApiResponse::sendResponse('Ads retrieved successfully', $data, 200);
    }
    return ApiResponse::sendResponse('No Ads found', [], 200);
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
  public function show(string $id)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
