<?php

namespace App\Http\Controllers\Gestions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CRUDCoursRequest;
use App\Models\Cour;
use Flashy;

class CoursController extends Controller
{
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CRUDCoursRequest $request)
    {
    	// dd($request);
        Cour::updateOrCreate([
                                    'idcours' => $request->idcours
                                ],
                                [
                                    'lib' => $request->cours,'ponderation' => $request->ponderation,'idtitulaires' => $request->titulaire, 'idauditoires' => $request->idauditoires
                                ]); 
       
        Flashy::success('Opération éffectuée avec succès');
        return redirect()->back();          
    }
}
