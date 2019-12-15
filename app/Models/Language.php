<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_idiomas';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id','nom'];
    public $timestamps = false;
}