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
        return response()->json(['title'=>__('messages.success'),'message'=>__('messages.store'),'status'=>'success']);
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
        return response()->json(['title'=>__('messages.success'),'message'=>__('messages.update'),'status'=>'success']);
    }
    public function destroy($id)
    {
        try{
        $row = DB::table("roles")->where('id',$id)->delete();

        return response()->json(['title'=>__('messages.success'),'message'=>__('messages.delete'),'status'=>'success']);

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
              return response()->json(['title'=>__('messages.success'),'message'=>__('messages.delete'),'status'=>'success']);

            }catch(\Exception $e){
                DB::rollBack();
              return response()->json($e->getMessage(), 500);
          }

    }
    }
