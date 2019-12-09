<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_secciones_libros';
    public $timestamps = false;
    protected $fillable = ['nom', 'num', 'titulo', 'id_est', 'id_lib'];
}
