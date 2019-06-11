<?php

namespace App\DataTables\Section;

use App\Models\Cour;
use Yajra\DataTables\Services\DataTable;

class ListeCoursByAuditoireDataTable extends DataTable
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
                return  
                    // '<a href="#" class="btn btn-success">
                    //   <span class=" fas fa-list"> </span>
                    // </a>'
                
                    // .'  '.
                    '<button type="button" class="edit-modal btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" data-info="'.$query->idcours.','.$query->lib.','.$query->ponderation.','.$query->idtitulaires.','.$query->idauditoires.'">
                      <span class="fas fa-edit"> </span>
                    </button>'
                   
                    .'  '.
                    '<button type="button" class="edit-modal btn btn-danger" data-toggle="modal" data-target="#exampleModalLong" data-info="'.$query->idcours.','.$query->lib.','.$query->ponderation.','.$query->idtitulaires.','.$query->idauditoires.'">
                      <span class=" fas fa-trash"> </span>
                    </button>'
                    ;
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
        return $model->CoursByAuditoire($this->idauditoires)->JoinTitulaire()
                    ->get([
                        'cours.idcours',
                        'cours.lib',
                        'cours.ponderation',
                        'cours.idauditoires',
                        'titulaires.idtitulaires',
                        'titulaires.nom',
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
                    ->addAction(['width' => '120px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return  [
            'lib'=>[
                        'name'=>'lib',
                        'data' => 'lib',
                        'title' => 'Cours',
                        'searchable' => true,
                        'orderable' => false,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'nom'=>[
                        'name'=>'nom',
                        'data' => 'nom',
                        'title' => 'Titulaire',
                        'searchable' => true,
                        'orderable' => false,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
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
        return 'Section/ListeCoursByAuditoire_' . date('YmdHis');
    }
}
