<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Invoice extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user_info_invoice_id' => $this->user_info_invoice_id,
            'status' => $this->status,
            'type' => $this->type,
            'serie' => $this->serie,
            'inv_number' => $this->inv_number,
            'uuid' => $this->uuid,
            'total' => $this->total,
            'currency' => $this->currency,
            'method_pay' => $this->method_pay,
            'date_invoice' => $this->date_invoice,
            'check_in' => $this->check_in
        ];
    }

}
