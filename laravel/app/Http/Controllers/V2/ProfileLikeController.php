<?php

namespace App\Http\Controllers\V2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileLikeController extends Controller
{
    public function index(Request $request) {
        $user = $request->user();

        return response()->json(
            $user->like, 200
        );
    }
}
