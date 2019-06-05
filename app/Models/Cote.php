<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cote extends Model
{
   protected $primaryKey = 'idcotes';
   public $timestamps = false;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idetudiants','ponderation','idcours','idtype_cotes','cote'
    ];

    public static function getFicheCote($idcours,$idtype_cotes){
    	$cote = self::GetByCours($idcours)
    				 ->GetByTypeCote($idtype_cotes);
    	$auditoire = Auditoire::find(Cour::find($idcours)->idauditoires);

    	return Etudiant::leftJoinSub($cote, 'cotes', function ($join) {
                        $join->on('etudiants.idetudiants', '=', 'cotes.idetudiants');
                    })->where('idauditoires',$auditoire->idauditoires);
                      
    }

    /**
    * Cour join prof
    */
   public static function scopeJoinEtudiant($query){
        return $query->rightJoin('etudiants','etudiants.idetudiants','cotes.idetudiants');
    }

   public static function scopeGetByCours($query,$idcours){
        return $query->where('cotes.idcours',$idcours);
    }

   public static function scopeGetByTypeCote($query,$idtype_cotes){
        return $query->where('cotes.idtype_cotes',$idtype_cotes);

    }
}
