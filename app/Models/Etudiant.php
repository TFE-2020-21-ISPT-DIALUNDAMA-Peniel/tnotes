<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
     /**
     * définit la clé primaire personalisée.
     *
     * @var array
     */
    protected $primaryKey = 'idetudiants';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matricule','nom','postnom','prenom','idauditoires','frais','idprofils','commentaire','statut'
    ];
    public $timestamps =false;

    // /**
    //  * Evénement éloquent lors de la creation d'un étudiant
    //  * l'année academique en cours est recuperée automatique
    //  */
    // protected static function boot(){
    //     parent::boot();

    //     static::creating(function($etudiant){
    //         $etudiant->annee_acad = Gestion_annee::getAnneeAcademiqueEnCours()->idgestion_annees;

    //     });
    // }

    public static function getNbrEtudiantByAuditoire($idauditoire){
        return self::where('idauditoires',$idauditoire)->count();
    }
    public static function getNbrEtudiantActifByAuditoire($idauditoire){
        return self::where('idauditoires',$idauditoire)->EtudiantActif()->count();
    }
    public static function getNbrEtudiantByProfilByAuditoire($idauditoire,$profil){
        return self::join('profils','etudiants.idprofils','profils.idprofils')
                    ->where('etudiants.idauditoires',$idauditoire)
                    ->where('profils.lib',$profil)
                    ->count();
    }
  
    /**
    * recupere  les étudiants actifs
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantActif($query){

        return $query->where('etudiants.statut',true);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de la section  
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantParSection($query,$idsection){

        return $query->EtudiantJoinAuditoire()
                    ->where('auditoires.idsections','=',$idsection);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de l'auditoire'
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeEtudiantParAuditoire($query,$idauditoires){

        return $query->where('etudiants.idauditoires','=',$idauditoires);
                        

    }

    /**
    * recupere  les étudiants en tenant compte de l'auditoire'
    * @param $idsection identifiant de la Section de l'utilisateur selectionner 
    */

    public static function scopeProfilEtudiant($query){

        return $query->leftJoin('profils','etudiants.idprofils','=','profils.idprofils');
                        

    }

    /**
    * recupere  les étudiants non Enrôlés
    */

    public static function scopeEtudiantNonEnroles($query){

        return $query->leftJoin('enroles', 'etudiants.idetudiants', '=', 'enroles.idetudiants')
                        ->whereRaw('(enroles.idetudiants is NULL )');
                        

    }

    /**
    * Cour join prof
    */
   public static function scopeJoinCote($query){
        return $query->leftJoin('cotes','etudiants.idetudiants','cotes.idetudiants');
    }

}





