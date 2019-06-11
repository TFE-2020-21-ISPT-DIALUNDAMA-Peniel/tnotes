<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Section\ListeAuditoiresDataTable;
use App\DataTables\Section\AuditoiresImportDataTable;
use App\DataTables\Section\ListeEtudiantByAuditoireDataTable;
use App\DataTables\Section\ListeCoursByAuditoireDataTable;
use App\DataTables\Section\ListeProfesseursDataTable;
use App\DataTables\Section\ImportSessionDataTable;
// use App\DataTables\Section\BilanDataTable;
use App\Models\Auditoire;
use App\Models\Etudiant;
use App\Models\Cour;
use App\Models\Type_cote;
use Flashy;
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
	/*
    * Affiche la liste des auditoires
    * @param $dataTables un dataTable 
    * @return la vue liste_auditoire
    */
    public function index(){
    	return redirect()->route('section.getBilan');
    }
    
    /*
    * Affiche la liste des types de cotes
    * annee,examen,recours .... 
    */

    public function importSession(){
        $data = Type_cote::get();
        return view('section.session_import',compact('data'));
    }

    /*
    * Affiche la liste des auditoires
    * avec la route de liste de cours recu 
    * @return la vue liste_auditoire
    */

    public function getImportSession(Type_cote $type_cote, AuditoiresImportDataTable $dataTables){
        return $dataTables->with(['type_cote'=>$type_cote->idtype_cotes])->render('section.liste_auditoire',compact('section'));
    }

    /*
    * Affiche la fiche du cours récu
    * 
    * @return la vue liste_auditoire
    */
    public function getFicheImport(Type_cote $type_cote, Auditoire $auditoire,Cour $cour, AuditoiresImportDataTable $dataTables){
        return '';
    }



    /*
    * Affiche la liste des auditoires
    * @param $dataTables un dataTable 
    * @return la vue liste_auditoire
    */
    public function getListAuditoires(ListeAuditoiresDataTable $dataTables){
        return $dataTables->with(['route'=>'getCoursByAuditoire'])->render('section.liste_auditoire',compact('section'));
    }
    /*
    * retourne la liste des cours d'un auditoire
    * @param $dataTables un dataTable 
    * @return la vue liste_auditoire
    */
    public function getCoursByAuditoire(ListeCoursByAuditoireDataTable $dataTables,Auditoire $auditoire){
        return $dataTables->with(['idauditoires'=>$auditoire->idauditoires])->render('section.cours_auditoire',compact('auditoire'));
    }

    /*
    * retourne la liste des auditoires avec la route pour afficher les étudiant
    * @param $dataTables un dataTable 
    * @return la vue liste_auditoire
    */
    public function getListAuditoiresEtudiants(ListeAuditoiresDataTable $dataTables){
         return $dataTables->with(['route'=>'get_etudiants_by_auditoire'])->render('section.liste_auditoire',compact('section'));
    }
        /*
        * Affiche la liste des etudiant
        * @param $dataTables un dataTable 
        * @return la vue listeEtudiants
        */
    public function getListStudent(Auditoire $auditoire, ListeEtudiantByAuditoireDataTable $dataTables){
    	return $dataTables->with(['idauditoires'=>$auditoire->idauditoires])->render('section.listeEtudiants',compact('auditoire'));
    }

     /*
    * Affiche la liste des professeurs
    * @param $dataTables un dataTable 
    * @return la vue listeEtudiants
    */

    public function getListProfeseurs(ListeProfesseursDataTable $dataTables){
        return $dataTables->render('section.listeProfesseurs');
    }






    
}
