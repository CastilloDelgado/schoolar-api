<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfoInvoice extends Model {

    protected $table = 'user_info_invoice';

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
        'status',
        'name',
        'rfc',
        'email'
    ];

}
