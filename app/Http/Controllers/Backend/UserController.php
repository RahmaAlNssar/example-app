<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\DataTables\UserDataTable;
use Exception;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Arr;
use App\Http\Services\UserService;

class UserController extends Controller
{
    function __construct()
    {
     $this->middleware('permission:MultiDelete|users-create|users-multi-delete|users-update-status|users-destroy|users-index|users-edit', ['only' => ['index','store','MultiDelete','updateStatus']]);
    $this->middleware('permission:users-create', ['only' => ['create','store']]);
    $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
    $this->middleware('permission:users-destroy', ['only' => ['destroy']]);
    $this->middleware('permission:users-multi-delete', ['only' => ['MultiDelete']]);
    $this->middleware('permission:users-update-status', ['only' => ['updateStatus']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserDataTable $dataTable)
    {

        try{
            return $dataTable->render('backend.includes.table');

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
            $roles = Role::pluck('name', 'name')->all();
            return view('backend.users.form',compact('roles'));

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $UserService)
    {
        $user = $UserService->handle($request->all());
        if (is_string($user)) return $this->throwException($user);
         return response()->json(['title'=>'نجاح','message'=>'تمت العملية بنجاح','status'=>'success']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $row = User::where('id',$id)->first();
            $roles = Role::pluck('name', 'name')->all();
            $userRole = $row->roles->pluck('name', 'name')->all();

            return view('backend.users.form',compact('roles','row','userRole'));

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id,UserService $UserService)
    {
        $user = $UserService->handle($request->all(), $id);
        if (is_string($user)) return $this->throwException($user);
        return response()->json(['title'=>'نجاح','message'=>'تمت العملية بنجاح','status'=>'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try{
          $user = User::where('id',$id)->first();

          $user->delete();

            return response()->json(['title'=>'نجاح','message'=>' تم الحذف بنجاح','status'=>'success']);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function updateStatus($id){
        try{
            $user = User::where('id',$id)->first();
            $user->update(['status'=>!$user->status]);
              return response()->json(['title'=>'نجاح','message'=>'تم التحديث ','status'=>'success']);
          }catch(\Exception $e){
              return response()->json($e->getMessage(), 500);
          }
    }


    public function MultiDelete(Request $request){

        try{
           $rows = User::whereIn('id',(array)$request['id'])->get();
           DB::beginTransaction();
           foreach ($rows as $row)
               $row->delete();
           DB::commit();
              return response()->json(['title'=>'نجاح','message'=>'تم الحذف ','status'=>'success']);

            }catch(\Exception $e){
              return response()->json($e->getMessage(), 500);
          }

    }

}
