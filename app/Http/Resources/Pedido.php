<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProdServ as ProdServResource;

class Pedido extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'id_factura' => $this->id_factura,
            'id_forma_pago' => $this->id_forma_pago,
            'status' => $this->status,
            'total' => $this->total,
            'descuento' => $this->descuento,
            'productos' => $this->productos,
        ];
    }

}
