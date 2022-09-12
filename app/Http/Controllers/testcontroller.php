<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use App\DataTables\TestDataTable;
use App\DataTables\UserDataTable;
use App\Http\Controllers\BackendController;

class testcontroller extends BackendController
{
    public function __construct(TestDataTable $dataTable ,Test $user){
        parent::__construct($dataTable,$user);
    }




}
