<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdServ extends Model {

    protected $table = 'prod_serv';

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
        'codigo',
        'nombre',
        'descripcion',
        'monto',
        'tipo_monto',
        'clave_sat',
        'clave_producto'
    ];

   

}
