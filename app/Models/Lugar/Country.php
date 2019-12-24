<?php

namespace App\Models\Lugar;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_paises';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','nom','nac','moneda'];
    public $timestamps = false;
}