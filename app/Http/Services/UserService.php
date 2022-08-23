<?php
namespace App\Http\Services;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService{

    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();

            if ($request['password'] == null)
            unset($request['password']);

        $user = User::updateOrCreate(['id' => $id],$request);

        $user->syncRoles($request['roles'] ?? []);
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
