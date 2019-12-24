<?php

namespace App\Models\Member;

use Illuminate\Database\Eloquent\Model;

class Telefono extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_telefonos';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['cod_pais', 'cod_area', 'num', 'id_lector'];
}
