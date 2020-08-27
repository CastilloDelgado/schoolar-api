<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppConfiguration extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "logo_url" => $this->logo_url,
            "vector_url" => $this->vector_url,
            "color_hex" => $this->color_hex,
            "titulo" => $this->login_message_title,
            "mensaje" => $this->login_message_text
        ];
    }
}
