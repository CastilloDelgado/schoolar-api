<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyInformation extends Model
{
    protected $fillable = [
        "nombre",
        "segundo_nombre",
        "apellido_paterno",
        "apellido_materno",
        "fecha_de_nacimiento",
        "email",
        "pais_de_origen",
        "ciudad_de_origen",
        "calle",
        "numero",
        "telefono",
        "information_id"
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
