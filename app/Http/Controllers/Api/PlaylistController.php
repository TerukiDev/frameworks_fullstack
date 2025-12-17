<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $playlists = $user->playlists()->with('tracks')->get();

        return response()->json($playlists);
    }
}
