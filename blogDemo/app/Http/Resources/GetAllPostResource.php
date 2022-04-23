<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAllPostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "email" => $this->email,
            "description" => $this->discription,
            "creation date" => $this->created_at,
            "user id" => $this->user_id,
            "slug" => $this->slug,
            "comments" => CommentResource::Collection($this->comments)
        ];
    }
}
