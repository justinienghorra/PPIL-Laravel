<?php

namespace App\Http\Controllers\Notification;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator;

class NotificationController extends Controller
{
    public function deleteNotification(Request $req) {
        $validator = Validator::make($req->all(), [
            'id_notification' => 'required|exists:notifications,id'
        ]);

        if ($validator->fail()) {
            return response()->withErrors($validator);
        }

        $notif = Notification::where('id', $req->id_notification);
        if ($notif->utilisateur_a_notifie == Auth::user()->id) {
            $notif->delete();
        }

        return response();
    }
}
