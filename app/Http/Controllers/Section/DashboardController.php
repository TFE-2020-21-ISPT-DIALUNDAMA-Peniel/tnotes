<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\Section\ListeAuditoiresDataTable;
use App\DataTables\Section\ListeEtudiantByAuditoireDataTable;
use App\DataTables\Section\ListeCoursByAuditoireDataTable;
// use App\DataTables\Section\BilanDataTable;
use App\Models\Auditoire;
use App\Models\Etudiant;
use App\Models\Cour;
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
    * @return la vue acceuil
    */
    public function index(){
    	return redirect()->route('section.getBilan');
    }

    /*
    * Affiche la liste des auditoires
    * @param $dataTables un dataTable 
    * @return la vue acceuil
    */
    public function getListAuditoires(ListeAuditoiresDataTable $dataTables){
        return $dataTables->render('section.acceuil',compact('section'));
    }
    /*
    * retourne la liste des cours d'un auditoire
    * @param $dataTables un dataTable 
    * @return la vue acceuil
    */
    public function getCoursByAuditoire(ListeCoursByAuditoireDataTable $dataTables,Auditoire $auditoire){
        return $dataTables->with(['idauditoires'=>$auditoire->idauditoires])->render('section.cours_auditoire',compact('auditoire'));
    }
        /*
        * Affiche la liste des etudiant
        * @param $dataTables un dataTable 
        * @return la vue listeEtudiants
        */
    public function getListStudent(Auditoire $auditoire, ListeEtudiantByAuditoireDataTable $dataTables){
    	return $dataTables->with(['idauditoires'=>$auditoire->idauditoires])->render('section.listeEtudiants',compact('auditoire'));
    }




    
}
