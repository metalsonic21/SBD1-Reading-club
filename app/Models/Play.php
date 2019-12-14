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
    protected $fillable = ['id', 'nom', 'resum'];
    public $timestamps = false;
}
