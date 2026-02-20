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

  /**
   * Get ads based on domain API endpoint
   */
  // public function getAdByDomain($domain, $domain_id)
  // {
  //   $ads = Ad::where('domain', $domain)->where('domain_id', $domain_id)->get();

  // }

  public function getAdByDomain($domain_id)
  {
    // return response()->json($domain_id, 200); // TEST:
    $ad = Ad::where('domain_id', $domain_id)->get();

    if (count($ad) > 0) {
      return ApiResponse::sendResponse('Ads in the domain retrieved successfully', AdResource::collection($ad), 200);
    }
    return ApiResponse::sendResponse('No Ad found', [], 200);
  }

  /**
   * Search the ads
   * @param Request $request
   */
  public function search(Request $request)
  {
    // $query = $request->input('search'); // Old
    // $query = $request->has('search') ? $request->input('search') : null; // NEW
    // OR
    $search_word = $request->input('search') ?? null; // NEW

    // Check if the search word is provided and not empty
    if ($search_word === null || trim($search_word) === '') {
      return ApiResponse::sendResponse('Please use a search word', [], 400);
    }

    // Perform the search function here
    $ads = Ad::where('title', 'LIKE', "%{$search_word}%")
      ->orWhere('text', 'LIKE', "%{$search_word}%")
      ->get();

    if (count($ads) > 0) {
      return ApiResponse::sendResponse('Search results retrieved successfully', AdResource::collection($ads), 200);
    } else {
      return ApiResponse::sendResponse('No Ads found for the search query, try another search words', [], 200);
    }
    // TEST: return a JSON response with the search word
    // return response()->json(['queryParameter' => $query], 200);
  }
}
