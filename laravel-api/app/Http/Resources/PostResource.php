<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'post_id'=>$this->id,
            'post_title'=>$this->title ,
            'post_body'=>$this->body,
            'post_image'=>"/images/{$this->image}",
            // 'posted_by'=>$this->posted_by,
            // 'posted_by' => $this->user ? $this->user->name : "no creator",
            'posted_by' => $this->user ? new UserResource($this->user) :  "no creator",
      ];
    }
}
