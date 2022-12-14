<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix'=>'dashboard','as'=>'backend.'],function(){
    //users
   Route::resource('users', 'App\Http\Controllers\Backend\UserController');
    Route::post('users/{id}',[App\Http\Controllers\Backend\UserController::class,'updateStatus'])->name('users.update_status');
    Route::delete('user/multi_delete',[App\Http\Controllers\Backend\UserController::class,'MultiDelete'])->name('users.mult.delete');
    //roles
   Route::resource('roles', 'App\Http\Controllers\Backend\RoleController');
    Route::delete('roles/delete/multi_delete',[App\Http\Controllers\Backend\RoleController::class,'MultiDelete'])->name('roles.mult.delete');

    // users excel
    Route::get('users/export', [App\Http\Controllers\Backend\ImportExportController::class, 'export'])->name('users.export');
    Route::put('/imports',[App\Http\Controllers\Backend\ImportExportController::class,'import'])->name('users.imports');


    // Route::get('test/create',[App\Http\Controllers\testcontroller::class,'create'])->name('test.create');
    // Route::get('test',[App\Http\Controllers\testcontroller::class,'index'])->name('test.index');

});


