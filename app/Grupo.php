<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Grupo extends Model
{
    use Notifiable;

    protected $fillable = ['grado', 'grupo'];

    public function users()
    {
        return $this->hasMany(Information::class);
    }

    public function grado()
    {

        return $this->belongsTo(Grado::class);
    }

    public function materias()
    {
        return $this->grado->materias();
    }
}
