@extends('layouts.admin')
@section('title')
المدراء
@endsection

@section('content')




        <div class="content-detached">
            <div class="content-body">
                <div class="card">

                    <a href="{{ route('backend.'.getModel().'.mult.delete') }}" class="btn btn-outline-danger col-lg-2 multi-delete" style="margin: 10px"><i class="fas fa-trash"></i>حذف الجميع</a>

                    <div class="card-content collpase show">
                        <div class="card-body table-responsive">
                            <div class="card-body">
                                {{$dataTable->table()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush
