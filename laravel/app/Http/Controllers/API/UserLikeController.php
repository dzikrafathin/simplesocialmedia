<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Like;
use App\User;
use Illuminate\Http\Request;

class UserLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $ret = array();
        foreach ($user->like as $like) {
            $tmp = [
                "id" => $like->id,
                "isi" => $like->postingan->isi,
                "userId" => $like->user_id,
                "nama" => $like->postingan->user->nama,
                "foto" => $like->postingan->user->foto
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
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
