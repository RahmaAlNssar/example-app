<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function status(){
       if (canUser("users-update-status") == true ){
        return  $this->status == 1
        ? '<a href="'.route('backend.users.update_status',$this->id).'"class="btn btn-outline-success btn-sm toggle-class"> <span class="badge bg-success"><i class="fa fa-power-off"></i></span></a>'
        : '<a href="'.route('backend.users.update_status',$this->id).'"class="btn btn-outline-danger btn-sm toggle-class">  <span class="badge bg-danger"><i class="fa fa-power-off"></i></span></a>';

       }
     else{
        return "";
     }
    }
}
