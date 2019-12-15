<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_instituciones';
    protected $fillable = ['nom', 'tipo', 'id_ciudad'];
    public $timestamps = false;
}