<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

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

          Permission::create(['name'=>'users-create','name_ar'=>'إضافة مستخدم']);
          Permission::create(['name'=>'users-index','name_ar'=>'قائمة المستخدمين']);
          Permission::create(['name'=>'users-edit','name_ar'=>'تعديل مستخدم']);
          Permission::create(['name'=>'users-destroy','name_ar'=>'حذف مستخدم']);
          Permission::create(['name'=>'users-update-status','name_ar'=>'تعديل حالة المستخدم']);
          Permission::create(['name'=>'users-multi-delete','name_ar'=>'حذف متعدد للمستخدمين']);
          Permission::create(['name'=>'roles-create','name_ar'=>'إضافة صلاحية']);
          Permission::create(['name'=>'roles-index','name_ar'=>'قائمة الصلاحيات']);
          Permission::create(['name'=>'roles-edit','name_ar'=>'تعديل صلاحية']);
          Permission::create(['name'=>'roles-destroy','name_ar'=>'حذف صلاحية']);
          Permission::create(['name'=>'roles-multi-delete','name_ar'=>'حذف متعدد للصلاحيات']);
    }
}
