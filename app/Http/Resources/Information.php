<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Information extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'grupo_id' => $this->grupo_id,
            'nombre' => $this->nombre,
            'segundo_nombre' => $this->segundo_nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'fecha_de_nacimiento' => $this->fecha_de_nacimiento,
            'email' => $this->email,
            'pais_de_origen' => $this->pais_de_origen,
            'ciudad_de_origen' => $this->ciudad_de_origen,
            'grado' => $this->grupo->grado_id,
            'grupo' => $this->grupo->grupo
        ];
    }

    public function with($request) {
        return [
            'version' => '1.0.0',
            'author_url' => url('Nothing')
        ];
    }

}
