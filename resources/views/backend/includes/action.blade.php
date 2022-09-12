
<div class="row" style="margin-left: 10px;">
    @can(getModel().'-edit')
    <a href="{{route('backend.'.getModel().'.edit',$row) }}" type="button" class="btn btn-outline-primary  col" title="تعديل"><i class="fa fa-edit"></i></a>
    @endcan
    @can(getModel().'-destroy')
    <a href="{{route('backend.'.getModel().'.destroy',$row) }}" type="button" class="btn btn-outline-danger  col" title="حذف" id="warning" data-id="{{$row}}"><i class="fa fa-trash"></i></a>
    @endcan
</div>
