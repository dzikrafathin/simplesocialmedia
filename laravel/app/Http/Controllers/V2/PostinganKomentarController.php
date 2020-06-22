<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Postingan;
use App\Komentar;
use App\User;

use App\Http\Requests\TambahKomentar;
use App\Http\Requests\UbahKomentar;
use App\Http\Requests\HapusKomentar;

class PostinganKomentarController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function index(Postingan $postingan) {
        return $postingan->komentar()->get();
    }

    public function store(TambahKomentar $request, Postingan $postingan) {
         
        $user = $request->user();
        
        $komentar = new Komentar;
        
        $komentar->isi = $request->isi;
        $komentar->postingan_id = $postingan->id;
        $komentar->user_id = $user->id;

        $komentar->save();
        
        $user = $user->toArray();
        $user['komentar'] = $komentar;
        
        return response()->json([
            "message" => "Komentar berhasil ditambahkan kedalam postingan",
            "data" => $user
        ],201);
    }

    public function update(UbahKomentar $request, Komentar $komentar) {
        
        $user = $request->user();

        $komentar->isi = $request->isi;
        $komentar->save();

        $user = $user->toArray();
        $user['komentar'] = $komentar;
        
        return response()->json($user,200);
    
    }

    public function destroy(HapusKomentar $request, Komentar $komentar) { 

        $komentar->delete();

        return response()->json(null,204);
    }

}
