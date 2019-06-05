<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
   protected $primaryKey = 'idcours';
   public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lib','ponderation','idtitulaires','idauditoires'
    ];
   

   /**
    * Recupere tout les étudiants du cours
    * 1 cours apartien à 1 auditoire
    * donc recupere les etudiant d'un auditoire
    */
   public static function scopeCoursGetStuden($query){
        return $query->leftJoin('etudiants','etudiants.idauditoires','cours.idauditoires');
    }
   /**
    * Cour par scopeCoursByAuditoire
    */
   public static function scopeCoursByAuditoire($query,$idauditoires){
        return $query->where('cours.idauditoires',$idauditoires);
    }

    /**
    * Cour par Prof
    */
   public static function scopeCoursByTitulaire($query,$idtitulaires){
        return $query->where('cours.idtitulaires',$idtitulaires);
    }

   /**
    * Cour join prof
    */
   public static function scopeJoinTitulaire($query){
        return $query->leftJoin('titulaires','titulaires.idtitulaires','cours.idtitulaires');
    }
   /**
    * Cour join prof
    */
   public static function scopeJoinAuditoire($query){
        return $query->leftJoin('auditoires','auditoires.idauditoires','cours.idauditoires');
    }

       /**
    * Cour join prof
    */
   public static function scopeJoinCote($query){
        return $query->CoursGetStuden()->
        leftJoin('cotes','cotes.idcours','cours.idcours')->where('etudiants.idetudiants','cotes.idetudiants');
    }
}
