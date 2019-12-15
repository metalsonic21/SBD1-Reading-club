<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_reuniones_mensuales';
    public $timestamps = false;
    public $incrementing = false;
    public $primaryKey = 'fec';
    protected $fillable = ['fec','id_lib', 'id_grupo', 'id_grupo_mod', 'id_fec_mem', 'id_fec_i', 'id_club', 'id_lec', 'n_ses', 'conclu', 'valor'];

    //ALTER TABLE SJL_reuniones_mensuales ADD CONSTRAINT reuniones_grupo_mod_fk FOREIGN KEY(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo) REFERENCES SJL_grupos_lectores(id_fec_i,id_fec_mem,id_club,id_lec,id_grupo) ON DELETE CASCADE;
    //Esto es para que recuerdes que es para el moderador
}
