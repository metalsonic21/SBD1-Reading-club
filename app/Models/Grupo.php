<?php

namespace App\Models;

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
    protected $fillable = ['id_club', 'nom', 'tipo', 'dia_sem', 'hora_i', 'hora_f'];
}
