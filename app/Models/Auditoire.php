<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoire extends Model
{
    protected $primaryKey = 'idauditoires';
	
    public static function getAuditoireGroupBySection(){

        return self::join('sections','sections.idsections','=','auditoires.idsections')->get(['idauditoires','auditoires.lib','auditoires.abbr','sections.idsections','sections.lib as section_lib'])->groupBy('idsections');

    }

    

    /**
    * Auditoires trié
    */

    public static function scopeTrieAuditoire($query){

        
        return $query->orderBy('idpromotions','ASC')
                     ->orderBy('idsections','ASC')
                     ->orderBy('idfacultes','ASC')
                     ->orderBy('idauditoires','ASC');

    }

    /**
    * auditoire par section
    */
   public static function scopeAuditoireBySection($query,$idsections){
        return $query->where('auditoires.idsections',$idsections);
    }


}
