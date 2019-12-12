<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_historicos_pagos_memb';
    public $timestamps = false;
    protected $fillable = ['id_fec_mem', 'id_club', 'id_lec', 'fec_emi'];
}
