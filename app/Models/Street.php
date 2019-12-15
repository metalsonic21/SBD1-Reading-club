<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_calles';
    protected $fillable = ['nom','cod_post','id_urb'];
    public $timestamps = false;
}