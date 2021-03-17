<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','role_id'
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

    public function ads(){
        return $this->hasMany(Ad::class);
    }

    public function favorites(){
        return $this->belongsToMany(Ad::class,'favorites')->withPivot(['ad_id','user_id']);
    }

    public function isFavorites(Ad $ad){
        return $this->favorites()->wherePivot('ad_id',$ad->id)->count();
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function isAdmin(){
        return $this->role->id==1;
    }
}
