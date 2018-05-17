<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use DB;
use App\CreativeRoom;
use App\CreativeroomUser;
use App\Repositories\ActivationTokenRepository;
use App\Repositories\Interfaces\CreativeRoomRepositoryInterface;
use Mail;
use App\Http\Controllers\Controller;
use Storage;
use App\Project;
use App\ProjectFile;
use Illuminate\Support\Str;

class CreativeRoomController extends Controller
{
    const FILES_PER_PAGE = 10;
    const NORMAL_MESSAGE_TYPE = 1;

    /**
     * @var CreativeRoomRepositoryInterface
     */
    protected $repository;

    public function __construct (CreativeRoomRepositoryInterface $repository) {
        $this->repository = $repository;
        $this->middleware('auth');
    }

    /**
     * Get all room of user
     */
    public function showRoom()
    {

        $rooms = CreativeRoom::select('title', 'id', 'updated_at', 'thumbnail', 'user_id')
            ->with(['owner' => function($que) {
                $que->select('id','name','photo','photo_thumbnail');
            }])

            ->withCount(['creativeroomUsers' => function($q) {
                $q->where('state', 1);
            }])

            ->whereHas('creativeroomUsers', function($query) {
                $query->where([
                    ['user_id', '=', Auth::user()->id],
                    ['state', '=', true]
                ]);
            })->get();

            //create s3 file path
            for ($idx = 0; $idx < count($rooms); $idx++) {
                $owner = $rooms[$idx]->owner;

                if (!empty($rooms[$idx]->thumbnail)) {
                    $rooms[$idx]->thumbnail = Storage::disk('s3')->url($rooms[$idx]->thumbnail);
                }

                $rooms[$idx]->owner->photo_thumbnail = $owner->photoThumbnailUrl;
            }

        return response()->json([
            'status'   => 'success',
            'message'  => 'Get data success',
            'data' => $rooms
        ], 200);      
    }

    public function previewFiles(Request $request) {
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

        $previewFiles = $room->previewFiles()
            ->orderByDesc('created_at')
            ->paginate(self::FILES_PER_PAGE);

        return response()->json([
                'status' => 'success',
                'message' => 'Get preview files',
                'data' => $previewFiles
            ], 200);
    }

    public function createRoom(Request $request) {
        //check user permission
        if (Auth::user()->cant('create', CreativeRoom::class)) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'permission denied',
                'data'     => [],
            ], 403);
        }

        //validate form input
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'desc' => 'required|max:4000',
                'thumbnail' => 'image'
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title max length is 255 character',
                'desc.required' => 'Describe is required',
                'desc.max' => 'Describe max length is 4000 character',
                'thumbnail.image' => 'Thumbnail must be a picture'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                    'status' => 'Bad request',
                    'message' => 'Some field are invalid',
                    'data' => $validator->errors()
                ], 400);
        }

        $input = [
            'title' => $request->input('title'),
            'desc' => $request->input('desc'),
            'user_id' => Auth::user()->id,
            'invitation_token' => Str::random(10)
        ];

        if ($request->hasFile('thumbnail')) {
            $input['thumbnail'] = $request->thumbnail->storePublicly('creative_rooms/'.Auth::id(), 's3');
        } else {
            $input['thumbnail'] = config('const.creative_room_thumbnails.' . rand(0, 9));
        }

        //TODO: save creative room
        $creativeRoom = $this->repository->create($input);

        $creativeRoom->creativeroomUsers()->create([
            'user_id' => Auth::user()->id,
            'role' => CreativeroomUser::MASTER_ROLE,
            'state' => 1,
        ]);

        //create s3 file path
        if (!empty($creativeRoom->thumbnail)) {
            $creativeRoom->thumbnail = Storage::disk('s3')->url($creativeRoom->thumbnail);
        }

        return response()->json([
                'status' => 'success',
                'message' => 'Room created',
                'data' => $creativeRoom
            ]);
    }

    function roomInfo(Request $request) {
        $room_id = $request->room_id;
        $room = $this->repository->findOrFail($room_id);
        return response()->json([
                'status' => 'success',
                'message' => 'Get room info',
                'data' => $room
            ], 200);
    }

    function updateRoom(Request $request) {
        $validator = Validator::make($request->all(),
            [
                'title' => 'required|max:255',
                'desc' => 'required|max:4000'
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title max length is 255',
                'desc.required' => 'Describe is required',
                'desc.max' => 'Describe max length is 4000'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                    'status' => 'bad request',
                    'message' => 'Some field are not valid',
                    'data' => $validator->errors()
                ], 400);
        }

        $room = $this->repository->findOrFail($request->room_id);

        //check user permission
        if (Auth::user()->cant('update', $room)) {
            return response()->json([
                'status'   => 'error',
                'message'  => 'permission denied',
                'data'     => [],
            ], 403);
        }

        $input = $request->only('title', 'desc');

        //Save thumbnail
        if ($request->hasFile('thumbnail')) {
            $input['thumbnail'] = $request->thumbnail->storePublicly('creative_rooms/'.Auth::id(), 's3');
        }

        $room->fill($input);
        $room->save();

        return response()->json([
                'status' => 'success',
                'message' => 'Edit success',
                'data' => $room
            ], 200);

    }

}
