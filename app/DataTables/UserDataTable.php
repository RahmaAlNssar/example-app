<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = true;
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
            ->editColumn('status',function($row){
                return $row->status();
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

            // ->editColumn('ExportImport', function($row){
            //     return view('backend.includes.importExport',['row'=>$row->id])->render();
            // })
            ->rawColumns(['created_at','action','id','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('is_admin',0)->orderBy('id','desc')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->setTableAttribute('id','example')
                    ->setTableAttribute('class', 'example table table-striped  table-primary table-hover table-responsive-md data-table  table-fixed  display responsive nowrap')
                    ->buttons(
                        Button::make('create')->addClass((canUser("users-create") ?? "" )),
                       Button::make('excelHtml5'),
                        Button::make('pdfHtml5'),
                        //Button::make('reset'),
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
            Column::make('name')->title('??????????'),
            Column::make('email')->title('???????????? ????????????????????'),
            Column::make('status')->title('????????????'),
            Column::make('created_at')->title('?????????? ??????????????'),
            Column::make('updated_at')->title('?????????? ??????????????'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center')->title('??????????????'),
            //Column::computed('ExportImport')->title('?????????????? ???????????? ????????')


        ];
    }

    public function fastExcelCallback()
    {
        return function ($row) {
            return [
                'Name' => $row['name'],
                'Email' => $row['email'],
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
        return 'User_' . date('YmdHis');
    }
}
