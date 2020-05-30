<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Postingan;
use App\User;
use Illuminate\Http\Request;

class UserPostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $user->postingan()->with('user:id,nama,foto')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $user = $request->user();
        $postingan = $user->postingan()->create($request->except('media'));

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $url = $media->store('public');
                $postingan->media()->create([
                    "nama" => $media->getClientOriginalName(),
                    "url" => $url,
                    "jenis" => "foto"
                ]);
            }
        }
        $id = $postingan->id;

        $ret = Postingan::with('user:id,nama,foto')->where('id','=',$id)->get();
        return response()->json($ret[0],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(Postingan $postingan)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postingan $postingan)
    {
        //
    }
}
