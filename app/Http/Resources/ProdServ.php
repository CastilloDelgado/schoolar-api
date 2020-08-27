<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdServ extends JsonResource
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
            'id' => $this->id,
            'codigo' => $this->codigo,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'monto' => $this->monto,
            'tipo_monto' => $this->tipo_monto,
            'clave_sat' => $this->clave_sat,
            'clave_producto' => $this->clave_producto,
        ];
    }
}
