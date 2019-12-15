<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_clubes_lectura';
    protected $fillable = ['nom', 'fec_crea', 'cuota', 'id_dir', 'id_idiom', 'id_inst'];
    public $timestamps = false;
}