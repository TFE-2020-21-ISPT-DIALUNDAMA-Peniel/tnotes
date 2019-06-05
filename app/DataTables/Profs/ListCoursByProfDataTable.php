<?php

namespace App\DataTables\Profs;

use App\Models\Cour;
use Yajra\DataTables\Services\DataTable;

class ListCoursByProfDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('action', function($query){
                return '<button type="button" class="fiche-cote btn btn-block btn-info"  data-info="'.$query->idcours.'," data-toggle="modal" data-target="#exampleModalCenter"><span class= "fas fa-list"> </span> Fiches de cotes</button>';


                // '
                // <div class="row">
                //     <div class="col-sm-6">
                //         <a href="#" class="btn btn-info btn-block">Année</a>
                //         <br>
                //     </div>

                //     <div class="col-sm-6">
                //         <a href="#" class="btn btn-info btn-block">Examen</a>
                //     </div>
                // </div>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cour $model)
    {
        return $model->CoursByTitulaire($this->idtitulaires)
                     ->JoinTitulaire()
                     ->JoinAuditoire()
                     ->orderBy('auditoires.idauditoires')
                     ->get([
                        'cours.idcours',
                        'cours.idauditoires',
                        'cours.idtitulaires',
                        'cours.lib as cours',
                        'cours.ponderation',
                        'auditoires.lib as auditoire',
                        'titulaires.nom',
                        'titulaires.postnom',
                        'titulaires.prenom',
                     ]);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->addAction(['width' => '200px'])
                    ->parameters($this->getBuilderParameters());
    }

    // /**
    //  * Get columns.
    //  *
    //  * @return array
    //  */
    // protected function getColumns()
    // {
    //     return [
    //         'id',
    //         'add your columns',
    //         'created_at',
    //         'updated_at'
    //     ];
    // }

        /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return  [
            'cours'=>[
                        'name'=>'cours',
                        'data' => 'cours',
                        'title' => 'Cours',
                        'searchable' => true,
                        'orderable' => false,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'auditoire'=>[
                        'name'=>'auditoire',
                        'data' => 'auditoire',
                        'title' => 'Promotion',
                        'searchable' => true,
                        'orderable' => false,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            // 'nom'=>[
            //             'name'=>'nom',
            //             'data' => 'nom',
            //             'title' => 'Titulaire',
            //             'searchable' => true,
            //             'orderable' => false,
            //             // 'render' => 'pap',
            //             'exportable' => true,
            //             'printable' => true,
            //         ],
            'ponderation'=>[
                        'name'=>'Ponderation',
                        'data' => 'ponderation',
                        'title' => 'ponderation',
                        'searchable' => true,
                        'orderable' => false,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
                ];
    }

    protected function getBuilderParameters(){
        return [

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Profs/ListCoursByProf_' . date('YmdHis');
    }
}
