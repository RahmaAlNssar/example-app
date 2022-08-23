<?php
namespace App\Http\Services;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleService {

    public function handle($request,$id = null){

        try{
            DB::beginTransaction();
            $role = Role::updateOrCreate(['id'=>$id],$request);
            $role->syncPermissions($request['permission'] ?? []);
            DB::commit();
            return $role;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}
