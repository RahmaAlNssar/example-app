<?php

namespace App\DataTables;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('created_at',function($row){
                return $row->created_at->diffForHumans();
            })

            ->editColumn('id',function($row){

                return view('backend.includes.checkbox',['row'=>$row->id])->render();
            })
            ->editColumn('updated_at',function($row){
                return $row->updated_at->diffForHumans();
            })
            ->editColumn('action', function($row){
                return view('backend.includes.action',['row'=>$row->id])->render();
            })
            ->rawColumns(['created_at','action','id']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->orderBy('id','desc')->where('name','!=','manager')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('role-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->setTableAttribute('class', 'example table table-striped  table-primary table-hover table-responsive-md data-table  table-fixed  display responsive nowrap')
                    ->buttons(
                        Button::make('create')->addClass((canUser("roles-create") ?? "" )),

                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [

            Column::make('id')->title('<input class="form-check-input" type="checkbox" value="" id="select_all" onClick="toggle(this)">')->exportable(false)->printable(false)->orderable(false)->searchable(false)->width(15)->addClass('text-center'),
            Column::make('name')->title('اسم الصلاحية'),
            Column::make('created_at')->title('تاريخ الانشاء'),
            Column::make('updated_at')->title('تاريخ التعديل'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')->addClass('row')->title('العملية'),
        ];
    }

    public function fastExcelCallback()
    {
        return function ($row) {
            return [
                'Id' => $row['id'],
                'Name' => $row['name'],

            ];
        };
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Role_' . date('YmdHis');
    }
}
