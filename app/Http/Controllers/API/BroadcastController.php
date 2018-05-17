<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Pusher;
use Auth;

class BroadcastController extends Controller
{
    public function apiEndpoint (Request $request) {
    	$user = Auth::user();
        $pusher = new Pusher(
        	env('PUSHER_APP_KEY'),
        	env('PUSHER_APP_SECRET'),
        	env('PUSHER_APP_ID'),
        	array( 'cluster' => env('PUSHER_APP_CLUSTER'),
        		'encrypted' => true
        	)
        );
        return $pusher->presence_auth($request->channel_name, $request->socket_id, $user->id);
    }
}
