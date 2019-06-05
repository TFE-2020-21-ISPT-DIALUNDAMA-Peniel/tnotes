<?php

namespace App\DataTables\Comptabilite;

use App\Models\Auditoire;
use Yajra\DataTables\Services\DataTable;

class ListeAuditoiresDataTable extends DataTable
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
                return '<a href="'.route('comptabilite.getListStudent',$query->idauditoires).'" class="edit-modal btn btn-outline-secondary"><i class="fas fa-list"></i> Afficher</a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Auditoire $model)
    {
        return $model::get();
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
        return [
            'lib'=>[
                        'name'=>'lib',
                        'data' => 'lib',
                        'title' => 'Auditoires',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'abbr'=>[
                        'name'=>'abbr',
                        'data' => 'abbr',
                        'title' => 'Abbréviation',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],

            
        ];
    }

    protected function getBuilderParameters(){
        return [
            'dom' => '',
            'order' => [[1,'Asc']]
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
