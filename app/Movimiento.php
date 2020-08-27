<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model {

    protected $table = 'movimiento';

    /**
     * The primary key associated with the table.
     *
     * @var integer
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_pedido',
        'status',
        'monto'
    ];

}
