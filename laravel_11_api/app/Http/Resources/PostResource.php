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
            // 'creator_id'=>$this->creator_id,
            // 'creator_id' => $this->creator_id ? $this->creator->name : "no creator",
            // 'creator_id' => $this->creator_id ? new UserResource($this->creator) :  "no creator",
            'creator' => $this->creator,
        ];
    }
}
