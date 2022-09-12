<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    public $dataTable,$model;

    public function __construct($dataTable,$model){
        $this->dataTable = $dataTable;
        $this->model = $model;
    }
    public function index(){
        try{
            return $this->dataTable->render('backend.includes.table');
        }catch(\Exception $e){
            return response()->json($e->getMessages(),500);
        }

    }

    public function create(){
        try{

          return view('backend.includes.form');
        }catch(\Exception $e){
            return response()->json($e->getMessages(),500);
        }
    }
    public function getModel(){
        return class_basename($this->model);
    }
}
