<?php

namespace App\Models\Obra;

use Illuminate\Database\Eloquent\Model;

class Elenco_Principal extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_elenco';
    protected $primaryKey = 'id_fec_mem';
    public $incrementing = false;
    protected $fillable = ['id_fec_mem', 'id_lec', 'id_club', 'id_pers', 'id_obra', 'principal'];
    public $timestamps = false;
}
