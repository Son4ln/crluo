<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CreativeRoom;
use App\CreativeroomUser;
use App\CreativeroomMessage;
use App\Events\MessageReceived;
use App\Mail\RoomHasMessage;
use App\Notifications\AlertRoomMessage;
use App\User;
use App\Events\EmailShouldBeSent;
use App\Mail\HasCrluoMessage;
use Auth;
use Validator;
use DB;
use Mail;
use Storage;
use App\Repositories\Interfaces\CreativeroomMessageRepositoryInterface;
use App\Repositories\Interfaces\CreativeRoomRepositoryInterface;

class MessageController extends Controller
{
	const NORMAL_MESSAGE_TYPE = 1;
    const FILES_PER_PAGE = 10;
	 /**
     * @var CreativeroomMessageRepositoryInterface
     */
    protected $messageRepository;

    /**
     * @var CreativeRoomRepositoryInterface
     */
    protected $roomRepository;

    /**
     * Create a new controller instance.
     *
     * @param CreativeRoomRepositoryInterface $repository
     */
     public function __construct (CreativeroomMessageRepositoryInterface $messageRepository, CreativeRoomRepositoryInterface $roomRepository) {
        $this->roomRepository = $roomRepository;
        $this->messageRepository = $messageRepository;
        $this->middleware('auth');
    }
     /**
     * Store messages of user
     */
    public function storeMessage(Request $request)
    {
        // validate message
        $validator  = Validator::make($request->all(), [
        	'kind' => 'required',
        	'creativeroom_id' => 'required',
            'message' => 'required_if:files,[]|max:4000',
            'files'   => 'required_if:message,'
        ],[
        	'kind.required' => 'Kind is required',
        	'creativeroom_id.required' => 'Creativeroom id is required',
            'message.required_if' => 'Message is required'
        ]);

        if($validator->fails()){
            return response()->json([
            	'status' => 'bad request',
            	'message' => 'some field are not valid',
            	'data' => $validator->errors()
            ], 400);
        }

        //check user permission
        $room = $this->roomRepository->findOrFail($request->input('creativeroom_id'));
        if (Auth::user()->cant('show', $room)) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'permission denied',
                'data'     => [],
            ], 403);
        }

        $input = $request->only('creativeroom_id', 'kind', 'message');
        $input['files'] = $request->input('files');
        $input['user_id'] = $request->user()->id;
        if ($request->has('recipient_id')) {
            $input['recipient_id'] = $request->input('recipient_id');
            if ($input['recipient_id'] == 0) $input['is_public'] = 1;
        }
        $files = $room->files()->createMany($this->filesToArray($request->input('files')));
        $message = $this->messageRepository->create($input);

        //Get return messages
        if($request->input('kind') == self::NORMAL_MESSAGE_TYPE) {
            broadcast(new MessageReceived($message))->toOthers();
        }

        //create s3 file path
        $info_user = $message->user;
        $message->user_name = $info_user->name;
        $message->user_photo = $info_user->photoUrl;
        unset($message->user);
        
        return response()->json([
                'status'   => 'success',
                'message'  => "Get message and file",
                'data'     => $message
            ], 200);
    }

    /**
     * Convert json which contain files to saveable array
     */
    public function filesToArray($files)
    {
        $files = json_decode($files, true);
        if (!$files) return [];
        $fileStore = [];

        foreach ($files as $file) {
            $fileStore[] = [
                'title'   => $file['name'],
                'mime'    => isset($file['thumb']) ? 'image' : 'other',
                'path'    => $file['path'],
                'user_id' => Auth::id(),
                'thumb_path' => isset($file['thumb']) ? $file['thumb'] : '',
            ];
        }
        return $fileStore;
    }
    
    /**
     * Get files on chat room
     */
    public function filesOnChatRoom(Request $request) {
        $room = Creativeroom::with('project:id,estimate,describe,title')
            ->with(['roomUsers' => function($q) {
                $q->select('name', 'photo', 'photo_thumbnail')
                    ->where('state', 1);
            }])->find($request->room_id);

        if($room){
            if (Auth::user()->cant('show', $room)) {
                return response()->json([
                    'status'   => 'error',
                    'message'  => 'permission denied',
                    'data'     => [],
                ], 403);
            }
        }

        $files = $room->projectFiles()
                ->orderByDesc('created_at') 
                ->paginate(self::FILES_PER_PAGE);

        return response()->json([
                'status' => 'success',
                'message' => 'get files on chat room',
                'data' => $files
            ]);
    }
}
