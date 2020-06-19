<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Postingan;

class UserPostinganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function detail(Postingan $postingan, User $user) {
        
        $jumlahLike = $postingan->like()->count();
        $jumlahKomentar = $postingan->komentar()->count();
        $disukai = $postingan->like->contains($user);

        $postingan = $postingan->toArray();
        array_pop($postingan);

        if (empty($postingan['user'])) {
            $postingan['user'] = $user;
        } 

        $data = [
            "jumlah_like" => $jumlahLike,
            "jumlah_komentar" => $jumlahKomentar,
            "disukai" => $disukai
        ];

        $postingan['data'] = $data;

        return $postingan;
        
    }

    public function index(User $user) {
        
        $daftarPostingan = $user->postingan()->get();
        $data = [];

        foreach ($daftarPostingan as $postingan) {
            $postingan = $this->detail($postingan, $user);
            array_push($data,$postingan);
        }

        return $data;
    }

}
