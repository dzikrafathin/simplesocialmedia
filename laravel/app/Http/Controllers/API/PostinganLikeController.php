<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Like;
use App\Postingan;
use Illuminate\Http\Request;

class PostinganLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Postingan $postingan)
    {
        $user = $request->user();
        
        $ret = array();
        $ret_like = array();
        
        if ($user) {
            $liked = $user->like()->where('postingan_id',$postingan->id)->first();
        } else {
            $liked = false;
        }
        
        if ($liked) {
            $ret_like = [
                "disukai" => true,
                "likeId" => $liked->id
            ];
        } else {
            $ret_like = [
                "disukai" => false,
                "likeId" => null
            ];
        }

        foreach ($postingan->like as $like) {
            $tmp = [
                "id" => $like->id,
                "userId" => $like->user->id,
                "nama" => $like->user->nama,
                "foto" => $like->user->foto
            ];
            array_push($ret,$tmp);
        }

        return response()->json([
            "userLike" => $ret_like,
            "daftarSuka" => $ret
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Postingan $postingan)
    {
        $user = $request->user();
        $error = $user->like()->where('postingan_id',$postingan->id)->first();
        
        if ($error) {
            
            return response()->json([
                "error" => "Sudah disukai"
            ],422);

        } else {
            
            $like = $user->like()->create();
            $like->postingan()->associate($postingan);
            $like->save();

            return response()->json($like,200);
        }

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
    public function destroy(Request $request, Like $like)
    {
        $user = $request->user();
        $id = $like->user->id;
        if ($user->id == $id) {
            $like->destroy();
        } else {
            return response()->json([
                "error" => "Tidak diizinkan"
            ],403);
        }
    }
}
