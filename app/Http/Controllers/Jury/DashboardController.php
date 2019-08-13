<?php

namespace App\Http\Controllers\Jury;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Type_cote;
use App\Models\Auditoire;
use App\Models\Fiches_envoye;
use App\Models\Cour;

use App\DataTables\Jury\ListAuditoireDataTable;
use App\DataTables\Jury\List_cours_auditoireDataTable;
use App\DataTables\Jury\FicheCotesDataTable;



class DashboardController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    	$data = Type_cote::get();
    	return view('jury.index',compact('data'));
    }

        /*
    * Affiche la liste des auditoires
    * avec la route de liste de cours recu 
    * @return la vue liste_auditoire
    */

    public function getImportSession(Type_cote $type_cote, ListAuditoireDataTable $dataTables){
        return $dataTables->with(['type_cote'=>$type_cote->idtype_cotes])->render('jury.liste_auditoire');
    }

    public function getCoursImportByAuditoire(Type_cote $type_cote, Auditoire $auditoire, List_cours_auditoireDataTable $dataTables){

        return $dataTables->with(['type_cote'=>$type_cote->idtype_cotes,'auditoire'=>$auditoire->idauditoires])->render('jury.liste_cours_auditoire');

    }

    /*
    * Affiche la fiche du cours récu
    * 
    * @return la vue liste_auditoire
    */
    public function getFicheImport(Fiches_envoye $fiches_envoye, FicheCotesDataTable $dataTables){
        $cours = Cour::JoinTitulaire()->find($fiches_envoye->idcours);
        $auditoire = Auditoire::find($cours->idauditoires);
        $type_cotes = Type_cote::find($fiches_envoye->idtype_cotes);
        return $dataTables->with(
                                [
                                    'idtype_cotes'=>$fiches_envoye->idtype_cotes,
                                    'type_cotes'=>$type_cotes->lib,
                                    'idcours'=>$fiches_envoye->idcours,
                                    'titulaire'=>$cours->nom,
                                    'cours'=>$cours->lib,
                                    'auditoire'=>$auditoire->abbr
                                ])->render('jury.fiche_cote',compact('cours','type_cotes','auditoire'));
    }

}
