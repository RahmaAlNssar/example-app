@extends('layouts.admin')
@section('title')
{{__('sidebar.users')}}
@endsection
@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
@endsection
@section('content')



<section class="content">

    <div class="container-fluid">
        <br>
        <div class="row container">
            @can('users-index')
            <a href="{{ route('backend.users.index') }}" class="btn btn-info">
              رجوع
            </a>
            @endcan
        </div>
        <br>
        <div class="content-detached">
            <div class="content-body">
                <div class="card">


                    <div class="card-body">


                        @if(isset($row))
                        <form action="{{route('backend.users.update',$row->id)}}" method="post" class="submit">
                            @csrf
                        @method('put')
                        @else
                        <form action="{{route('backend.users.store')}}" method="post"  class="submit" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            @endif
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">الاسم:</label>
                                <input type="text" class="form-control" name="name" value="{{$row->name ?? old('name')}}" id="name">
                                <span class="error text-danger d-none"></span>
                            </div>
                            <div class="form-group">
                                <label for="recipient-email" class="col-form-label">البريد الالكتروني:</label>
                                <input type="email" class="form-control" name="email" value="{{$row->email ?? old('email')}}" id="email">
                                <span class="error text-danger d-none"></span>
                            </div>
                            <div class="form-group">
                                <label for="recipient-password" class="col-form-label">كلمة المرور:</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password')}}" id="password">
                                <span class="error text-danger d-none"></span>
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="col-form-label">تأكيد كلمة المرور:</label>
                                {!! Form::password('confirm-password', array('class' => 'form-control')) !!}

                                <span class="error text-danger d-none"></span>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="recipient-role" class="col-form-label">المنصب:</label>

                                    @if(isset($row))
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                                   @else
                                   {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                                    @endif
                                </div>
                                <span class="error text-danger d-none"></span>
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
