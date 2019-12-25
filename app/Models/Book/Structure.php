<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_estructuras_libros';
    public $timestamps = false;
    protected $fillable = ['id_lib', 'nom', 'tipo', 'titulo'];
}
