<?php

namespace App\DataTables\Section;

use App\Models\Titulaire;
use Yajra\DataTables\Services\DataTable;

class ListeProfesseursDataTable extends DataTable
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
                return '<button type="button" class="edit-modal btn btn-primary" data-toggle="modal" data-target="#editModal" data-info="'.$query->idtitulaires.','.$query->matricule.','.$query->nom.','.$query->postnom.','.$query->prenom.'">
                      <span class="fas fa-edit"> </span>
                    </button>'

                     .'  '.
                    '<button type="button" class="edit-modal btn btn-danger" data-toggle="modal" data-target="#editModal" data-info="'.$query->idcours.','.$query->lib.','.$query->ponderation.','.$query->idtitulaires.','.$query->idauditoires.'">
                      <span class=" fas fa-trash"> </span>
                    </button>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Titulaire $model)
    {
        return $model->where('idgrades',1)->get();
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
                    ->addAction(['width' => '100px'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // 'idtitulaires',
            'matricule',
            'nom',
            'postnom',
            'prenom',
            'pseudo',
            // 'nom',
            
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
        return 'Section/ListeProfesseurs_' . date('YmdHis');
    }
}
