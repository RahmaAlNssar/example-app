@extends('layouts.admin')
@section('title')
    المدراء
@endsection

@section('content')
    <div class="content-detached">
        <div class="content-body">
            <div class="card">
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2">
                        @can(getModel() . '-multi-delete')
                            <a href="{{ route('backend.' . getModel() . '.mult.delete') }}"
                                class="btn btn-outline-danger  multi-delete" style="margin: 10px"><i class="fas fa-trash"></i>حذف
                                الجميع</a>
                        @endcan

                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2">

                        @include('backend.includes.importExport')
                    </div>

                </div>
                <div class="card-content collpase show">
                    <div class="card-body table-responsive data_table">

                        {{ $dataTable->table() }}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}






@endpush
