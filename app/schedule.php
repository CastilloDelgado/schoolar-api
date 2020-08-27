<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $table = 'schedule';

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
        'materia_id',
        'group_id',
        'user_id',
        'status',
        'day',
        'hour',
        'slot'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'status' => 1,
    ];

}
