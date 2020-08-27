<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
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
        "user_id",
        "grupo_id",
        "emergency_information_id",
        "tipo_id",
        "imagen_url"
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'usuario_id ');
    }

    public function emergency_information()
    {
        return $this->hasOne(EmergencyInformation::class);
    }

    public function materias()
    {
        return $this->grupo->grado->materias();
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }
}
