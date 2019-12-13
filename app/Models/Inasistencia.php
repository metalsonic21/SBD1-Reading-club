<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inasistencia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_inansistencias';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_fec_i','id_fec_mem', 'id_club', 'id_lec', 'id_grupo', 'fec_reu_men', 'id_lib'];
}
