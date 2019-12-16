<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_historicos_presentaciones';
    protected $fillable = ['fec', 'id_obra', 'id_local','hora_i','durac','valor','num_asist','costo','id_club'];
    public $timestamps = false;
    public $incrementing = false;
}

/* SJL_historicos_presentaciones (
    fec        DATE NOT NULL,
    id_obra    INTEGER NOT NULL,
    id_local   INTEGER NOT NULL,
    hora_i     TIME NOT NULL,
    durac      TIME NOT NULL,
    valor      NUMERIC(3),
    num_asist  INTEGER,
    costo      INTEGER NOT NULL,
    CONSTRAINT hist_presentaciones_pk PRIMARY KEY (fec,id_obra,id_local)
);*/
