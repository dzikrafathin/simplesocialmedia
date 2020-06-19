<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    protected $fillable = ['isi'];

    protected $with = ['user'];

    public function user() {
        return $this->belongsTo('App\User');
    }
    
    public function media() {
        return $this->hasMany('App\Media');
    }

    public function komentar() {
        return $this->belongsToMany('App\User','komentars')
            ->using('App\Komentar')
            ->as('komentar')
            ->withPivot('id', 'isi')
            ->withTimestamps();
    }

    public function like() {
        return $this->belongsToMany('App\User','likes')
            ->as('like')
            ->withTimestamps();
    }
}
