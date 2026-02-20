<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ApiResponse;
use App\Http\Requests\UpdateAdRequest;
use App\Http\Resources\V1\AdResource;
use App\Models\Ad;


class AhmedController extends Controller
{

  public function update_patch(Request $request, string $id)
  {
    $ad = Ad::find($id);

    $validated = $request->validate([
      // 'sometimes' means this is only required if the key exists in the JSON
      'title' => 'sometimes|required|min:3',
      // 'text' => 'sometimes|required|',
      // 'phone' => 'sometimes|required|min:10',
      // 'status' => ['sometimes', 'required', 'boolean'],
      // 'domain_id' => 'sometimes|required|exists:domains,id',
    ]);

    return response()->json([
      'message' => 'Validation successful',
      // 'data' => $validated
      'data' => $request->all()
    ], 200);


    if (!$ad) {
      return ApiResponse::sendResponse('Ad not found', [], 404);
    }


    if ($ad->user_id !== auth()->id()) {
      return ApiResponse::sendResponse('Unauthorized to update this Ad', [], 403);
    }

    // $this->authorize('update', $ad); // Authorize the action using the "AdPolicy"
    // In your controller, before $request->validated():
    // dd([
    //   'all' => $request->all(),           // Everything sent
    //   'method' => $request->method(),     // GET/POST/PUT/PATCH
    //   'content_type' => $request->header('Content-Type'),
    //   'has_title' => $request->has('title'),
    // ]);
    $data = $request->validated();
    $updated = $ad->update($data);

    if ($updated) {
      return ApiResponse::sendResponse('Your Ad updated successfully', new AdResource($ad), 200);
    }

    return ApiResponse::sendResponse('Ad not found', [], 404);
  }
}
