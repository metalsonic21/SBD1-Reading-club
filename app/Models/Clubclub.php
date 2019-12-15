<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clubclub extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_clubes_clubes';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['id_club1', 'id_club2'];
}
