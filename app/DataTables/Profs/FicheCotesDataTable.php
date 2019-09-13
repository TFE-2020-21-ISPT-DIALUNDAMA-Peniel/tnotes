<?php

namespace App\DataTables\Profs;

use App\Models\Cote;
use Yajra\DataTables\Services\DataTable;

class FicheCotesDataTable extends DataTable
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
                return '<button type="button" class="link-cote btn btn-info"  data-info="'.$query->idcotes.','.$query->cote.','.$query->idetudiants.','.$query->nom.'" data-toggle="modal" data-target="#exampleModalCenter"><span class= "fas fa-edit"> </span></button>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Cote $model)
    {
        return $model->getFicheCote($this->idcours,$this->idtype_cotes)
                     ->get([
                        // 'cours.idcours',
                        // 'cotes.ponderation',
                        'etudiants.idetudiants',
                        'etudiants.matricule',
                        'etudiants.nom',
                        'etudiants.postnom',
                        'etudiants.prenom',
                        'cotes.idcotes',
                        'cotes.cote',
                        'cotes.idtype_cotes',

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
                    ->addAction(['width' => 'auto'])
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
            'matricule'=>[
                        'name'=>'matricule',
                        'data' => 'matricule',
                        'title' => 'Matricule',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'nom'=>[
                        'name'=>'nom',
                        'data' => 'nom',
                        'title' => 'Nom',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'postnom'=>[
                        'name'=>'postnom',
                        'data' => 'postnom',
                        'title' => 'Postnom',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'prenom'=>[
                        'name'=>'prenom',
                        'data' => 'prenom',
                        'title' => 'Prenom',
                        'searchable' => true,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            'cote'=>[
                        'name'=>'cote',
                        'data' => 'cote',
                        'title' => 'Cote',
                        'searchable' => false,
                        'orderable' => true,
                        // 'render' => 'pap',
                        'exportable' => true,
                        'printable' => true,
                    ],
            
            // 'ponderation'=>[
            //             'name'=>'Ponderation',
            //             'data' => 'ponderation',
            //             'title' => 'ponderation',
            //             'searchable' => true,
            //             'orderable' => false,
            //             // 'render' => 'pap',
            //             'exportable' => true,
            //             'printable' => true,
            //         ],
                ];
    }
    protected function getBuilderParameters(){
        return [
            'dom' => 'flrtipB',
            'buttons' => [
                            $this->paramBtn('print','Imprimer'),
                            $this->paramBtn('pdf','PDF'),
                            $this->paramBtn('excel','Excel')

                ],
            'order' => [[1,'Asc']]
        ];
    }
    /**
     * parametres des attribut de btn.
     *
     * @return array
     */

    private function paramBtn($type,$name='Imprimer'){
        return [
                                'extend' => $type,
                                'filename' => 'Fiche'.$this->auditoire,
                                'title' => 'Fiche',
                                'message' => $this->auditoire,
                                'text' => $name,
                                'exportOptions' => [
                                                    'columns' => ':visible'
                                                    ],

                            ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Profs/FicheCotes_' . date('YmdHis');
    }
}
