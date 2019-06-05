<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiche_envoye extends Model
{
   protected $primaryKey = 'idfiche_envoye';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcours','idtype_cours'
    ];
}
