<?php

use Illuminate\Support\Facades\DB;


 function rules() {
  $url =request()->path();
    if(request()->segment(1) === 'dashboard' && request()->segment(2) !== ''){
        return request()->segment(2);
    }elseif(request()->segment(2) === 'dashboard' && request()->segment(3) !== ''){
        return request()->segment(3);
    }else{
        return 'Dashboard';
    }

 }

 function getModel(){
    return request()->segment(2);
}

 function canUser($permission){
    $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();
return in_array($permission,$permissions) ? true : false;
}
