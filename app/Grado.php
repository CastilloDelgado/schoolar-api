<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{

    public function materias()
    {
        return $this->hasMany(Materia::class);
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class);
    }
}
