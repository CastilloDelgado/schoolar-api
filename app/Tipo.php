<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    
    public function users()
    {
        return $this->hasMany(Information::class);
    }
}
