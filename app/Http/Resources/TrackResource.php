<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'image' => $this->image,
            'body' => $this->body,
            'tg_url' => $this->tg_url,
            'curator' => $this->curator,
            'url_image_original' => $this->url_image_original,
            'url_image_medium' => $this->url_image_medium,
            'url_image_thumbnail' => $this->url_image_thumbnail
        ];
    }
}
