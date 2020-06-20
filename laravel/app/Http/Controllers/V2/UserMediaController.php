<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class UserMediaController extends Controller
{
    public function index(User $user) {
        return $user->media;
    }
}
