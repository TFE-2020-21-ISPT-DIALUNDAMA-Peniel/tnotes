<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fiches_envoye extends Model
{
   protected $primaryKey = 'idfiches_envoyes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcours','idtype_cotes'
    ];

    public static function isSended($type_cote,$cours){
    	return self::where('idtype_cotes',$type_cote)
    		->where('idcours',$cours)->first();
    }
}
