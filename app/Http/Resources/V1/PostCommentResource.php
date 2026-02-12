<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCommentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      "id" => $this->id,
      "title" => $this->title,
      "body" => $this->body,
      'postId' =>  $this->post_id ?? null,
      // 'postTitle' =>  Post::find($this->post_id)->title ?? 'Unknown Post',
      "createdAt" => $this->created_at,
      "updatedAt" => $this->updated_at,
    ];
  }
}
