<?php
namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Traits\uploadImage;

class UserService{
use uploadImage;

    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();

            if (!empty($request['password'])) {
                $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }
        $user = User::updateOrCreate(['id' => $id],$request);
        $user->syncRoles($request['roles'] ?? []);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}
