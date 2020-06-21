<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


use App\Http\Requests\Login;
use App\Http\Requests\Daftar;
use App\Http\Requests\UbahProfil;
use App\User;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api')->except(['login','daftar']);
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
    
    public function profil(Request $request) {

        $user = $request->user();

        return response()->json($this->detail($user),200);

    }

    public function login(Login $request) {
        
        $user = User::where('email',$request->email)->first();

        if (Hash::check($request->password,$user->password)) {

            $user->api_token = Str::random(40);
            $user->save();

            $ret = [
                "message" => "Login berhasil",
                "data" => [
                    "user" => $user,
                    "token" => $user->api_token
                ]   
            ];

            return $ret;

        } else {
                
            return response()->json([
                "message" => "Terjadi kesalahan",
                "errors" => [
                    "password" => ["Password yang anda masukan salah"]
                ],
            ],422);
            
        }
        
    }

    public function daftar(Daftar $request) {

        $user = User::create($request->except('password','foto'));

        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public');
            $user->foto = $path;
        }

        $user->password = Hash::make($request->password);
        $user->api_token = Str::random(40);
        $user->save();

        $ret = [
            "message" => "Pendaftaran berhasil",
            "data" => [
                "user" => $user,
                "token" => $user->api_token
            ]   
        ];

        return response()->json(
            $ret,201
        );

    }

    public function update(UbahProfil $request) {
                
        $user = $request->user();

        $user2 = User::where('email',$request->email)->first();

        if ($user2) {
            if ($user->id != $user2->id) {

                $ret = [
                    "message" => "Terjadi kesalahan",
                    "errors" => [
                        "email" => "Alamat email ini sudah terdaftar"
                    ]   
                ];

                return response()->json($ret,422);
            }
        }

        $user->update($request->except('password','foto'));
        
        if ($request->hasFile('foto')) {
            $path = $request->foto->store('public');
            $user->foto = $path;
        }
        
        if ($request->has('password')) {
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
        }

        $user->save();

        return response()->json([
            "message" => "Profil berhasil diubah",
            "data" => [
                "user" => $this->detail($user)
            ]
        ],200);

    }

    public function logout(Request $request) {
        $user = $request->user();

        $user->api_token = null;
        $user->save();

        return response()->json(null,204);
    }

}
