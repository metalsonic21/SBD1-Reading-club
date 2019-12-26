<?php

namespace App\Models\Obra;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sjl_locales_eventos';
    protected $fillable = ['nom', 'tipo', 'cap', 'num_s', 'id_dir', 'id_club'];
    public $timestamps = false;
}
