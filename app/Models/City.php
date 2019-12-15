<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_ciudades';
    public $incrementing = false;
    protected $fillable = ['nom','id_pais'];
    public $timestamps = false;
}