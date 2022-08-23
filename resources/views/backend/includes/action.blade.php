@can(getModel().'-edit')
<a href="{{route('backend.'.rules().'.edit',$row) }}" type="button" class="btn btn-outline-primary" title="تعديل"><i class="fa fa-edit"></i></a>
@endcan
@can(getModel().'-destroy')
<a href="{{route('backend.'.rules().'.destroy',$row) }}" type="button" class="btn btn-outline-danger" title="حذف" id="warning" data-id="{{$row}}"><i class="fa fa-trash"></i></a>
@endcan
