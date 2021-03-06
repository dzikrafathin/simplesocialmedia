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
        'nama', 
        'email', 
        'password', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'alamat', 
        'no_hp', 
        'foto',
        'super_user',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token', 
        'api_token',
        'email', 
        'password', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'alamat', 
        'no_hp', 
        'email_verified_at',
        'super_user',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function postingan()  {
        return $this->hasMany('App\Postingan');
    }

    public function komentar() {
        return $this->belongsToMany('App\Postingan','komentars')
            ->using('App\Komentar')
            ->as('komentar')
            ->withPivot('isi')
            ->withTimestamps();
    }

    public function like() {
        return $this->belongsToMany('App\Postingan','likes')
            ->as('like')
            ->withTimestamps();
    }

    public function media() {
        return $this->hasManyThrough('App\Media','App\Postingan');
    }

}
