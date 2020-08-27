<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Schedule extends JsonResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request) {
        return [
            'id' => $this->id,
            'materia_id' => $this->materia_id,
            'group_id' => $this->group_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'day' => $this->day,
            'hour' => $this->hour,
            'slot' => $this->slot
        ];
    }

}
