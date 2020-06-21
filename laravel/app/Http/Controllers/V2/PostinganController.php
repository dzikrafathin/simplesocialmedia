<?php

namespace App\Http\Controllers\V2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Postingan;
use App\User;
use App\Http\Requests\TambahPostingan;
use App\Http\Requests\UbahPostingan;
use App\Http\Requests\HapusPostingan;

class PostinganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    private function cekIzin(User $user, Postingan $postingan) {
        return $user->id == $postingan->user_id;
    }

    public function index(Request $request)
    {
        $user = $request->user();

        $daftarPostingan = Postingan::all();
        $data = [];

        foreach ($daftarPostingan as $postingan) {
            $postingan = $this->detail($postingan, $user);
            array_push($data,$postingan);
        }

        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TambahPostingan $request)
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

        return response()->json($this->detail($postingan, $user),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function show(Postingan $postingan)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function edit(Postingan $postingan)
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
    public function update(UbahPostingan $request, Postingan $postingan)
    {
        $postingan->update($request->all());

        return response()->json($this->detail($postingan, $user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postingan  $postingan
     * @return \Illuminate\Http\Response
     */
    public function destroy(HapusPostingan $request, Postingan $postingan)
    {
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
        
    }
}
