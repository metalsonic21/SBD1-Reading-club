<?php

namespace App\Models\Member;
use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'sjl_membresias';
   public $incrementing = false;
   protected $fillable = ['fec_i', 'id_lec', 'id_club', 'estatus', 'fec_f', 'motivo_b'];
   public $timestamps = false;
}
