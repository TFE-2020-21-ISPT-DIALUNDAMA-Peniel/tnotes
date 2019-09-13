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

    public static function getFicheComplete($idcours){
        $auditoire = Auditoire::find(Cour::find($idcours)->idauditoires);
        $types_cotes = Type_cote::get();
        $cotes = array();
        foreach ($types_cotes as $type_c) {
            $cotes [str_slug($type_c->abbr)] = self::GetByCours($idcours)->selectRaw('cote as '.str_slug($type_c->abbr).' ,idetudiants')->where('idtype_cotes',$type_c->idtype_cotes);
        }
        // ----------------------------
        //  A REFAIRE
        // ---------------------------------
        $annee = $cotes['an'] ;
        $exam1 = $cotes['exam-1s'] ;
        $exam2 = $cotes['exam-2s'] ;

        // --------------------------------
        dump($annee->get());
        $etudiants =  Etudiant::leftJoinSub($annee, 'annee', function ($join) {
                        $join->on('etudiants.idetudiants', '=', 'annee.idetudiants');
                // })->leftJoinSub($exam1, 'exam1', function ($join) {
                //         $join->on('etudiants.idetudiants', '=', 'exam1.idetudiants');
                // })->leftJoinSub($exam2, 'exam2', function ($join) {
                //         $join->on('etudiants.idetudiants', '=', 'exam2.idetudiants');
                })->where('idauditoires',$auditoire->idauditoires)->where('etudiants.idetudiants',597)->get(['annee.an']);
        dump($etudiants);
        dd($types_cotes);

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
