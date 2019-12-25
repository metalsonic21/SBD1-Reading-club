<?php

namespace App\Models\Grupo;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_grupos_lectura';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id','id_club', 'nom', 'tipo', 'dia_sem', 'hora_i', 'hora_f'];
}
