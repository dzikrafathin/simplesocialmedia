<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Postingan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Postingan::with('user:id,nama,foto')->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(Postingan $postingan)
    {
        return response()->json($postingan,200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postingan $postingan)
    {
        $user = $request->user();
        if ($user->id == $postingan->user_id) {
            $postingan->update($request->all());
            return response()->json($postingan,200);
        } else {
            return response()->json([
                "error" => "Tidak diijinkan"
            ],403);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Postingan $postingan)
    {
        $user = $request->user();

        if ($user->id == $postingan->user_id) {
            foreach($postingan->media as $media) {
                Storage::delete($media->url);
                $media->delete();
            }
            foreach($postingan->like as $like) {
                $like->delete();
            }
            foreach($postingan->komentar as $komentar) {
                $komentar->delete();
            }

            $postingan->delete();

            return response()->json(null,204);
        } else {
            return response()->json([
                "error" => "Tidak diijinkan"
            ],403);
        }
        
    }
}
