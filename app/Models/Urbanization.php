<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Urbanization extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_urbanizaciones';
    protected $fillable = ['nom','id_ciudad'];
    public $timestamps = false;
}