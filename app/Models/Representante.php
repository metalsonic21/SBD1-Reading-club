<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Representante extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_representantes';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['doc_iden', 'nom1', 'nom2', 'ape1', 'ape2', 'fec_nac', 'id_dir'];
}
