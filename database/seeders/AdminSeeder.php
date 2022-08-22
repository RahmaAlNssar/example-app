<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
       'name'=>'admin',
       'email'=>'admin@gmail.com',
       'password'=>Hash::make('A123456'),
       'status'=>1,
       'is_admin'=>1
        ]);
        $role = Role::create(['name' => 'manager']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
