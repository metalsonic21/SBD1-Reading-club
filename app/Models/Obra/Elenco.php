<?php

namespace App\Models\Obra;

use Illuminate\Database\Eloquent\Model;

class Elenco extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_elenco_lectores';
    protected $primaryKey = 'id_hist_pre';
    public $incrementing = false;
    protected $fillable = ['id_hist_pre', 'id_obra', 'id_local', 'id_club', 'id_lec', 'id_pers', 'id_fec_mem', 'mej_act'];
    public $timestamps = false;
}
