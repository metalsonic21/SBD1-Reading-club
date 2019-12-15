<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Play_book extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'SJL_obras_libros';
    public $incrementing = false;
    protected $fillable = ['id_obra', 'id_lib'];
    public $timestamps = false;
}
