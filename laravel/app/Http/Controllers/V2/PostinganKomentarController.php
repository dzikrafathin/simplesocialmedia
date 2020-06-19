<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Postingan;
use App\Komentar;
use App\User;

class PostinganKomentarController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    private function cekIzin(User $user, Komentar $komentar) {
        return $user->id == $komentar->user_id;
    }

    public function index(Postingan $postingan) {
        return $postingan->komentar()->get();
    }

    public function store(Request $request, Postingan $postingan) {
        
        $validator = Validator::make($request->all(),[
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();
        
        $komentar = new Komentar;
        
        $komentar->isi = $request->isi;
        $komentar->postingan_id = $postingan->id;
        $komentar->user_id = $user->id;

        $komentar->save();
        
        $user = $user->toArray();
        $user['komentar'] = $komentar;
        
        return response()->json($user,201);
    }

    public function update(Request $request, Komentar $komentar) {
        
        $validator = Validator::make($request->all(),[
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();
        
        if ($this->cekIzin($user,$komentar)) {

            $komentar->isi = $request->isi;
            $komentar->save();

            $user = $user->toArray();
            $user['komentar'] = $komentar;
        
            return response()->json($user,200);

        } else {

            return response()->json([
                "error" => "Tidak diijinkan"
            ],403);

        }
    
    }

    public function destroy(Request $request, Komentar $komentar) {

        $user = $request->user();

        if ($this->cekIzin($user,$komentar)){

            $komentar->delete();

            return response()->json(null,204);

        } else {

            return response()->json([
                "error" => "Tidak diijinkan"
            ],403);
            
        }
    }

}
