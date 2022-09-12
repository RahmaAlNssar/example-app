<?php

namespace App\Http\Controllers\Backend;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function export()
    {
        try{
            return Excel::download(new UsersExport, 'users.xlsx');
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }


    }
    public function import(Request $request){
        // Excel::import(new UsersImport, $request->file('file')->store('Excel_Files'));
        Excel::import(new UsersImport, $request->file('file')->move('Excel_Files',$request->file('file')->getClientOriginalName()));
        return response()->json(['title'=>__('messages.success'),'message'=>__('messages.import'),'status'=>'success']);

    }
}
