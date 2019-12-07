<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_editoriales';
    public $timestamps = false;
    //protected $fillable = ['id', 'nom', 'id_pais'];
}
