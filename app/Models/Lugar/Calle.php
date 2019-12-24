<?php

namespace App\Models\Lugar;

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
    public $incrementing = false;
    protected $fillable = ['id','nom', 'cod_post', 'id_urb'];
}
