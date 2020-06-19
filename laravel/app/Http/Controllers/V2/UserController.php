<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\User;

class UserController extends Controller
{

    public function index() {
        return User::all();
    }

    public function show(User $user) {
        return response()->json($user, 200);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'email' => 'required|unique:App\User,email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 422);

        } else {

            $user = User::create($request->except('password','foto'));

            if ($request->hasFile('foto')) {
                $path = $request->foto->store('public');
                $user->foto = $path;
            }

            $user->password = Hash::make($request->password);
            $user->api_token = Str::random(40);
            $user->save();

            $ret = [   
                "user" => $user,
                "token" => $user->api_token
            ];

            return response()->json($ret,201);

        }
    }

    public function profil(Request $request) {

        $user = $request->user();

        return response()->json([
            "id" => $user->id,
            "nama" => $user->nama,
            "email" => $user->email,
            "tempat_lahir" => $user->tempat_lahir,
            "tanggal_lahir" => $user->tanggal_lahir,
            "alamat" => $user->alamat,
            "no_hp" => $user->no_hp
        ],200);

    }

    public function login(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {

            return response()->json($validator->errors(), 422);

        } else {

            $user = User::where('email',$request->email)->first();

            if ($user) {
                if (Hash::check($request->password,$user->password)) {
                    $user->api_token = Str::random(40);
                    $user->save();

                    $ret = [   
                        "user" => $user,
                        "token" => $user->api_token
                    ];

                    return $ret;

                } else {
                    return response()->json([
                        "password" => ["Password salah"]
                    ],422);
                }
            } else {
                return response()->json([
                    "email" => ["E-Mail tidak terdaftar"]
                ],422);
            }

        }
    }

}
