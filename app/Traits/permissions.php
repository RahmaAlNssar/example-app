<?php
namespace App\Traits;

trait permissions{

 public function Permissions(){
        $this->middleware('permission:users-create|users-multi-delete|users-destroy|users-index|users-edit', ['only' => ['index','store']]);
        $this->middleware('permission:users-create', ['only' => ['create','store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users-destroy', ['only' => ['destroy']]);
        $this->middleware('permission:users-multi-delete', ['only' => ['MultiDelete']]);
        $this->middleware('permission:users-update-status', ['only' => ['updateStatus']]);
    }


}
