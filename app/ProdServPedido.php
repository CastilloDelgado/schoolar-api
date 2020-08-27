    <?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdServPedido extends Model {

    protected $table = 'prod_serv_pedido';

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
        'id_prod_serv',
        'cantidad',
        'importe',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
    ];

    

}
