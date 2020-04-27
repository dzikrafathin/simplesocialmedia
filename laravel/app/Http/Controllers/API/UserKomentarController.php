<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Komentar;
use App\User;
use Illuminate\Http\Request;

class UserKomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $ret = array();
        foreach($user->komentar as $komentar) {
            $tmp = [
                "id" => $komentar->id,
                "isi" => $komentar->isi,
                "userId" => $komentar->postingan->user_id,
                "nama" => $komentar->postingan->user->nama,
                "foto" => $komentar->postingan->user->foto
            ];
            array_push($ret,$tmp);
        }
        return response()->json($ret,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function show(Komentar $komentar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komentar $komentar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Komentar  $komentar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Komentar $komentar)
    {
        //
    }
}
