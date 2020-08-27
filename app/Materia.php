<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
