<?php

namespace App\Http\Controllers\Profs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\DataTables\Profs\ListCoursByProfDataTable;
use App\DataTables\Profs\FicheCotesDataTable;
use App\Http\Requests\RedirectFicheRequest;
use App\Http\Requests\SetCoteRequest;
use App\Http\Requests\SendFicheRequest;
use App\Models\Cour;
use App\Models\Type_cote;
use App\Models\Auditoire;
use App\Models\Titulaire;
use App\Models\Cote;
use App\Models\Fiches_envoye;


class DashboardController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:titulaires');
    }

    // Affiche la liste des cours attribué au titulaire connecter
    public function index(ListCoursByProfDataTable $dataTables){
    	return $dataTables->with(['idtitulaires'=>auth()->user()->idtitulaires])->render('profs.index');
    }

    // genere le lien de fiche selon le type de cote

    public function redirectFiche(RedirectFicheRequest $request){

        return route('professeur.get_fiche',['idcours'=>$request->cours,'idtype_cote'=>$request->session]);
    }
    /**
     * retourne la fiche de cotes d'un cours 
     * @param $idcours
     * @param $type_cotes
     * @return dataTable
     */
    public function getFiche(Cour $idcours,Type_cote $idtype_cotes,FicheCotesDataTable $dataTables){
        if (auth()->user()->idtitulaires == $idcours->idtitulaires) {
            $auditoire = Auditoire::find($idcours->idauditoires);
            $prof = Titulaire::find($idcours->idtitulaires);

            return $dataTables->with(['idcours'=>$idcours->idcours,'idtype_cotes'=>$idtype_cotes->idtype_cotes,'idauditoires'=>$auditoire->idauditoires])->render('profs.fiche_cotation',compact('auditoire','prof','idcours','idtype_cotes'));
           
        }

        return abort(401);
    }

    /**
     * retourne la fiche de cotes d'un cours 
     * @param $idcours
     * @param $type_cotes
     * @return dataTable
     */
    public function sendFiche(Type_cote $type_cotes,Cour $cours){
       Fiches_envoye::create([
        'idcours'=>$cours->idcours,
        'idtype_cotes'=>$type_cotes->idtype_cotes,
       ]);
      return redirect()->back();     

    }

    /**
     * retourne la fiche de cotes d'un cours 
     * @param $idcours
     * @param $type_cotes
     * @return dataTable
     */
    public function setCote(SetCoteRequest $request){
        // dd($request->request);
        return Cote::updateOrCreate(
                        [
                            'idcotes' => $request->idcotes,

                        ],
                        [
                            'idetudiants' => $request->idetudiants,
                            'idcours' => $request->idcours,
                            'idtype_cotes' => $request->idtype_cotes,
                            'cote' => $request->cote,

                        ]
                     );
    }
}
