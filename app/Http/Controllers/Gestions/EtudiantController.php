<?php

namespace App\Http\Controllers\Gestions;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRUDEtudiantRequest;
use App\Models\Etudiant;
use Flashy;;

class EtudiantController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CRUDEtudiantRequest $request)
    {
    	// dd($request->request);
        Etudiant::updateOrCreate([
                                    'idetudiants' => $request->idetudiants
                                ],
                                [
                                    'matricule' => $request->matricule,
                                    'nom' => $request->nom,
                                    'postnom' => $request->postnom,
                                    'prenom' => $request->prenom, 
                                    'idauditoires' => $request->idauditoires,
                                ]); 
       
        Flashy::success('Opération éffectuée avec succès');
        return redirect()->back();          
    }
}
