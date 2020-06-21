<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Postingan;
use App\Media;
use App\User;

use App\Http\Requests\TambahMedia;
use App\Http\Requests\HapusMedia;

class PostinganMediaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index(Postingan $postingan) {
        return response()->json($postingan->media,200);
    }

    public function store(TambahMedia $request, Postingan $postingan) {

        $user = $request->user();
        $ret = [];

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $media) {
                $url = $media->store('public');
                $data = $postingan->media()->create([
                    "nama" => $media->getClientOriginalName(),
                    "url" => $url,
                    "jenis" => "foto"
                ]);
                array_push($ret,$data);
            }
            return response()->json([
                "message" => "Foto-foto berhasil ditambahkan kedalam postingan",
                "data" => $ret
            ],201);
        }
    }

    public function destroy(Request $request, $media) {

        $user = $request->user();
        $media = Media::findOrFail($media);
        
        if ($user->id == $media->postingan->user_id) {
            Storage::delete($media->url);
            $media->delete();
        } else {
            return response()->json([
                "message" => "Anda tidak diizinkan melakukan aksi ini"
            ],403);
        }
        
        return response()->json(null,204);
    }

}
