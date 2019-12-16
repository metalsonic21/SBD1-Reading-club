<?php

namespace App\Models\Remake;

use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_historicos_presentaciones';
    protected $primaryKey = 'fec';
    public $incrementing = false;
    protected $fillable = ['fec', 'id_obra', 'id_local', 'hora_i', 'durac', 'valor', 'num_asist', 'costo', 'id_club'];
    public $timestamps = false;
}
