<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use App\Postingan;
use App\Media;
use App\User;

class PostinganMediaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    private function cekIzin(User $user, Postingan $postingan) {
        return $user->id == $postingan->user_id;
    }
    
    public function index(Postingan $postingan) {
        return response()->json($postingan->media,200);
    }

    public function store(Request $request, Postingan $postingan) {

        $validator = Validator::make($request->all(),[
            'media' => 'required',
            'media.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();
        $ret = [];

        if ($this->cekIzin($user, $postingan)) {

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
                return response()->json($ret,201);
            }

        } else {
            return response()->json([
                "error" => "Tidak diizinkan"
            ],403);
        }

    }

    public function destroy(Request $request, $media) {

        $user = $request->user();
        $media = Media::find($media);
        
        if ($this->cekIzin($user, $media->postingan)) {
            Storage::delete($media->url);
            $media->delete();
            return response()->json(null,204);
        } else {
            return response()->json([
                "error" => "Tidak diizinkan"
            ],403);
        }

    }

}
