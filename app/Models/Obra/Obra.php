<?php

namespace App\Models\Obra;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_obras';
    protected $fillable = ['nom', 'resum'];
    public $timestamps = false;
}
