<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Play extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_obras';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'nom', 'resum', 'costo', 'durac', 'estatus', 'id_local'];
    public $timestamps = false;
}
