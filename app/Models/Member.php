<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'sjl_lectores';
   protected $primaryKey = 'doc_iden';
   public $incrementing = false;
   protected $fillable = ['doc_iden', 'nom1', 'nom2', 'ape1', 'ape2', 'fec_nac', 'genero', 'id_club', 'id_grup', 'id_calle', 'id_rep', 'id_rep_lec','id_nac'];
   public $timestamps = false;
}
