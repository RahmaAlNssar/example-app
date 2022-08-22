<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

          Permission::create(['name'=>'users-create']);
          Permission::create(['name'=>'users-index']);
          Permission::create(['name'=>'users-edit']);
          Permission::create(['name'=>'users-destroy']);
          Permission::create(['name'=>'users-update-status']);
          Permission::create(['name'=>'users-multi-delete']);
          Permission::create(['name'=>'roles-create']);
          Permission::create(['name'=>'roles-index']);
          Permission::create(['name'=>'roles-edit']);
          Permission::create(['name'=>'roles-destroy']);
          Permission::create(['name'=>'roles-multi-delete']);
    }
}
