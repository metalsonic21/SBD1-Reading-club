<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urbanizacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_urbanizaciones';
    public $timestamps = false;
    protected $fillable = ['nom', 'id_ciudad'];
}
