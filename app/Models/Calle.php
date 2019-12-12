<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calle extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_calles';
    public $timestamps = false;
    protected $fillable = ['nom', 'cod_post', 'id_urb'];
}
