<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Postingan;
use App\User;

class PostinganLikeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function detail(Postingan $postingan, $disukai) {
        
        $jumlahLike = $postingan->like()->count();
        $jumlahKomentar = $postingan->komentar()->count();

        return [
            "jumlah_like" => $jumlahLike,
            "jumlah_komentar" => $jumlahKomentar,
            "disukai" => $disukai
        ];
    }

    public function index(Postingan $postingan) {
        return $postingan->like()->get();
    }

    public function like(Request $request, Postingan $postingan) {
        $user = $request->user();
        if ($postingan->like->contains($user)) {
            return response()->json([
                "message" => "Postingan sudah disukai"
            ],422);
        } else {
            $postingan->like()->attach($user);
            echo $postingan->like->contains($user);
            
            return response()->json(
                $this->detail($postingan, true)
            ,200);
        }
    }

    public function unlike(Request $request, Postingan $postingan) {
        $user = $request->user();
        if ($postingan->like->contains($user)) {
            $postingan->like()->detach($user);
    
            return response()->json(
                $this->detail($postingan, false)
            ,200);
        } else {
            return response()->json([
                "message" => "Postingan belum disukai"
            ],422);
        }
    }

}