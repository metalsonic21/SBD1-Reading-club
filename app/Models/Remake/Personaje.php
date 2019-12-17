<?php

namespace App\Models\Remake;

use Illuminate\Database\Eloquent\Model;

class Personaje extends Model
{    
    /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'sjl_personajes';
   protected $fillable = ['id_obra', 'nom', 'descrip'];
   public $timestamps = false;
}
