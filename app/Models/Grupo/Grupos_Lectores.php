<?php

namespace App\Models\Grupo;

use Illuminate\Database\Eloquent\Model;

class Grupos_Lectores extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_grupos_lectores';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_fec_i', 'id_fec_mem', 'id_club', 'id_lec', 'id_grupo', 'fec_f'];
}
