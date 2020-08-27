<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Materia extends JsonResource
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
            'nombre' => $this->nombre,
            'ponderacion' => $this->ponderacion
        ];
    }

    public function with($request)
    {
        return [
            'version' => '1.0.0',
            'author_url' => url('Nothing')
        ];
    }
}
