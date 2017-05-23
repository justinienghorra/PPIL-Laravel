<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotifs(Request $request) {
        if (!Auth::check()) {
            return response()->json(['error' => 'Non autorisé'], 403);
        }

        $user = Auth::user();

        return response()->json($user->notifications);
    }
}
