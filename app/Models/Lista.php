<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_lista_favoritos';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_lec', 'id_lib', 'pref'];
}
