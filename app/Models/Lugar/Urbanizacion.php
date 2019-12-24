<?php

namespace App\Models\Lugar;

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
    public $incrementing = false;
    protected $fillable = ['id', 'nom', 'id_ciudad'];
}
