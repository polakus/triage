<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'estado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profesional(){
        return $this->hasOne('App\Profesional', 'id_user');
    }

    public function isOnline(){
        return Cache::has('user-is-online-'.$this->id);
    }
    // public function rol()
    // {
    //     return $this->belongsTo('App\Rol', 'id_rol');
    // }

    // public function esAdmin(){
    //     // if($this->rol->name=="Administrador"){
    //     if(true){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }
}