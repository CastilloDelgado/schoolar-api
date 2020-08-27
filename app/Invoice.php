<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {

    protected $table = 'invoice';

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
        'user_id',
        'user_info_invoice_id',
        'status',
        'type',
        'serie',
        'inv_number',
        'uuid',
        'total',
        'currency',
        'method_pay',
        'date_invoice',
        'check_in'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'type' => 1,
        'status' => 1,
        'check_in' => 0,
    ];

}
