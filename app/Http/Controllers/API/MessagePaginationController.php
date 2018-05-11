<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CreativeRoom;
use Auth;
use DB;
use Storage;

class MessagePaginationController extends Controller
{
    public function messagePagination (Request $request){
    	$pages = 5;

    	$room = Creativeroom::findOrFail($request->room_id);
        if (Auth::user()->cant('show', $room)) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'permission denied',
                'data'     => [],
            ], 403);
        }

    	if ($request->pages) {
    		$pages = $request->pages;
    	}

        $messages = \App\CreativeroomMessage::join('users','users.id','creativeroom_messages.user_id')
            ->select(DB::raw('creativeroom_messages.id, creativeroom_messages.files, creativeroom_messages.message, creativeroom_messages.created_at, creativeroom_messages.user_id, users.name as user_name, users.photo as user_photo')) 
            ->where([
                ['creativeroom_messages.kind', CreativeRoom::NORMAL_MESSAGE_TYPE],
                ['creativeroom_messages.creativeroom_id', $room->id ]
            ])
            ->whereNotNull('creativeroom_messages.creativeroom_id')
            ->latest('creativeroom_messages.created_at')->take($pages)->get()->reverse();

        //convert messages to array
        $messages_arr = [];
        foreach ($messages as $item) {
            if ($item->user_photo) {
                $item->user_photo = Storage::disk('s3')->url($item->user_photo);
            }
            array_push($messages_arr, $item);
        }

        return response()->json([
        	'status' => 'success',
        	'message' => 'get message success',
        	'data' => $messages_arr
        ], 200);
    }
}
