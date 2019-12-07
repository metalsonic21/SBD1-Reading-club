<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_libros';
    protected $primaryKey = 'isbn';
    public $incrementing = false;
    protected $fillable = ['isbn', 'titulo_esp', 'titulo_ori', 'tema_princ', 'sinop', 'n_pag', 'fec_pub', 'id_prev', 'id_edit'];
    public $timestamps = false;
}
