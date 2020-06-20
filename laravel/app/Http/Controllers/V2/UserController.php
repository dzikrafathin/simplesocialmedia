<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\User;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function detail(User $user) {
        return [
            "id" => $user->id,
            "nama" => $user->nama,
            "email" => $user->email,
            "tempat_lahir" => $user->tempat_lahir,
            "tanggal_lahir" => $user->tanggal_lahir,
            "alamat" => $user->alamat,
            "no_hp" => $user->no_hp
        ];
    }

    public function index() {
        return User::all();
    }

    public function show(User $user) {
        return response()->json($this->detail($user), 200);
    }

}
