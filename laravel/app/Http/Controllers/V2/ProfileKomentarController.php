<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class ProfileKomentarController extends Controller
{
    
    
    public function index(Request $request) {
        $user = $request->user();

        return response()->json($user->komentar,200);
    }
}
