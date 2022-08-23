<?php

namespace App\Http\Controllers\Backend;

use Exception;

use Illuminate\Http\Request;
use App\DataTables\RoleDataTable;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
{
$this->middleware('permission:roles-create|roles-edit|roles-index|roles-destroy', ['only' => ['index','store']]);
$this->middleware('permission:roles-create', ['only' => ['create','store']]);
$this->middleware('permission:roles-edit', ['only' => ['edit','update']]);
$this->middleware('permission:roles-destroy', ['only' => ['destroy']]);
$this->middleware('permission:roles-multi-delete', ['only' => ['MultiDelete']]);
}
    public function index(RoleDataTable $dataTable){
        try {
             return $dataTable->render('backend.includes.table');
    } catch (\Exception $e) {
              return response()->json($e->getMessage(), 500);
            }
    }
    public function create()
    {
        try {
        $permission = Permission::get();
        return view('backend.roles.form',compact('permission'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function store(RoleRequest $request,RoleService $RoleService)
    {

        $role = $RoleService->handle($request->all());
        if(is_string($role)) return throwException($role);
        return response()->json(['title'=>'نجاح','message'=>'تمت العملية بنجاح','status'=>'success']);
    }
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
        ->get();

     return view('roles.show',compact('role','rolePermissions'));
    }
    public function edit($id)
    {
        try{
        $row = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();

        return view('backend.roles.form',compact('row','permission','rolePermissions'));

    } catch (Exception $e) {
        return response()->json($e->getMessage(), 500);
    }
    }
    public function update(RoleRequest $request, $id,RoleService $RoleService)
    {
        $role = $RoleService->handle($request->all(),$id);
        if(is_string($role)) return throwException($role);
        return response()->json(['title'=>'نجاح','message'=>'تمت العملية بنجاح','status'=>'success']);
    }
    public function destroy($id)
    {
        try{
        DB::table("roles")->where('id',$id)->delete();
        return response()->json(['title'=>'نجاح','message'=>' تم الحذف بنجاح','status'=>'success']);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function MultiDelete(Request $request){

        try{
           $rows = Role::whereIn('id',(array)$request['id'])->get();
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
