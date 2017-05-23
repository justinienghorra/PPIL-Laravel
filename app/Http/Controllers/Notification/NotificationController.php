<?php

namespace App\Http\Controllers\Notification;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Validator;

class NotificationController extends Controller
{
    public function deleteNotification(Request $req) {
        $validator = Validator::make($req->all(), [
            'id_notification' => 'required|exists:notification,id'
        ]);

        if ($validator->fails()) {
            return response()->withErrors($validator);
        }

        $notif = Notification::where('id', $req->id_notification);
        if ($notif->id_utilisateur_a_notifie == Auth::user()->id) {
            $notif->delete();
        }

        return response();
    }
}
