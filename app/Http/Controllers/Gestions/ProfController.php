<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CRUDProfRequest;
use App\Models\Titulaire;
use Flashy;

class ProfController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CRUDProfRequest $request)
    {
    	// dd($request);
        Titulaire::updateOrCreate([
                                    'idtitulaires' => $request->idtitulaires
                                ],
                                [
                                    'matricule' => $request->matricule,
                                    'nom' => $request->nom,
                                    'postnom' => $request->postnom,
                                    'prenom' => $request->prenom, 
                                    'idgrades' => $request->idgrades ? $request->idgrades :1, 
                                ]); 
       
        Flashy::success('Opération éffectuée avec succès');
        return redirect()->back();          
    }
}
