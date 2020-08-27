<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model {

    protected $table = 'pedido';

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
        'id_usuario',
        'id_factura',
        'id_forma_pago',
        'status',
        'total',
        'descuento'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

    /* public function productos() {
      return $this->hasMany(ProdServPedido::class, 'id_pedido', 'id');
      } */

    public function productos() {
        return $this->belongsToMany(ProdServ::class, 'prod_serv_pedido', 'id', 'id_prod_serv');
        //return $this->morphTo(ProdServ::class, 'id', 'id_prod_serv');
    }

}
