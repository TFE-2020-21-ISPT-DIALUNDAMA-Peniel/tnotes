<?php

namespace App\DataTables\Jury;

use App\Models\Cour;
use App\Models\Fiches_envoye;
use Yajra\DataTables\Services\DataTable;

class List_cours_auditoireDataTable extends DataTable
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
                if ($fiches = Fiches_envoye::where('idcours',$query->idcours)->where('idtype_cotes',$this->type_cote)->first()){
                    return '<a href="'.route('jury.get_fiche',[$fiches->idfiches_envoyes]).'" class="btn btn-success btn-block">AFFICHER</a>';
                }
                return '<button type="button"  class="btn btn-danger" disabled>NON ENVOYER</button>';
                // return '<a href="'.route('get_fiche',[$query->]).'" class="btn btn-outline-secondary"><i class="fas fa-list"></i> Fiche de notes</a>';
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
        return $model::JoinTitulaire()->where(['idauditoires'=>$this->auditoire])->get();
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
                    ->addAction(['width' => '80px'])
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
                        'name'=>'Cours',
                        'data' => 'lib',
                        'title' => 'Auditoires',
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
                        'name'=>'Max',
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
        return 'Comptabilite/ListeAuditoires_' . date('YmdHis');
    }
}
