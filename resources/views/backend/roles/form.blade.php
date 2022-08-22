@extends('layouts.admin')
@section('title')
    الصلاحيات
@endsection
@section('content')
    <section class="content">

        <div class="container-fluid">
            <br>
            <div class="row container">
                <a href="{{ route('backend.roles.index') }}" class="btn btn-info">
                    رجوع
                </a>
            </div>
            <br>
            <div class="content-detached">
                <div class="content-body">
                    <div class="card">
                        <div class="card-body">
                            @if (isset($row))
                                <form action="{{ route('backend.roles.update', $row->id) }}" class="submit" method="post"
                                   enctype="multipart/form-data">
                                    @method('put')
                                @else
                                    <form action="{{ route('backend.roles.store') }}" method="post" class="submit"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">اسم الوظيفة:</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $row->name ?? old('name') }}" id="sname">
                                <span class="error red" id="name-error" style="color:red;"></span>
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">الصلاحيات:</label>
                                <div class="row">
                                    @foreach ($permission as $value)
                                        <div class="col-lg-2">
                                            @if (isset($row))
                                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                                    {{ $value->name_ar }}</label>
                                            @else
                                                <br>
                                                <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                                                    {{ $value->name_ar }}</label>
                                            @endif
                                        </div>
                                    @endforeach

                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                <button type="submit" class="btn btn-primary submit">حفظ</button>
                            </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection
