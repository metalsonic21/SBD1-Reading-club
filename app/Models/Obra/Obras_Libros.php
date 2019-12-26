<?php

namespace App\Models\Obra;

use Illuminate\Database\Eloquent\Model;

class Obras_Libros extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_obras_libros';
    protected $primaryKey = 'id_obra';
    public $incrementing = false;
    protected $fillable = ['id_obra', 'id_lib'];
    public $timestamps = false;
}
