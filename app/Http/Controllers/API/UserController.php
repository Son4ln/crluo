<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Validator;

class UserController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email',
            'password.required' => 'Password is required'
        ]
    );

        if($validator->fails()){
            return response()->json(
            	[
            		'status' => 'bad request',
            		'message' => 'invalid email and password',
            		'data' => $validator->errors()
            	],
            	400);
        }

        if(Auth::attempt([
            'email' => request('email'), 
            'password' => request('password')
        ])){
            $user = Auth::user();
            $user['photo'] = $user->photoUrl;
            $user['photo_thumbnail'] = $user->photoThumbnailUrl;
            $token = $user->createToken('MyApp')->accessToken;
            return response()->json(
            	[
            		'status' => 'success',
            		'message' => 'login success',
            		'data' => [
                        'token' => $token,
                        'user' => $user
                    ]
            	],
            	200);
        }
        else{
            return response()->json(
            	[
            		'status' => 'fail',
            		'message' => 'Wrong email or password',
            		'data' => []
            	], 401);
        }
    }    

    /**
     * Register User
     */
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ],
        [
        	'name.required' => 'Name is required.',
        	'email.required' => 'Email is required.',
        	'email.email' => 'Invalid email.',
        	'email.unique' => 'Email has been used.',
        	'password.required' => 'Password is required',
        	'c_password.required' => 'Confirm password is required',
        	'c_password.same' => 'Invalid confirm password'
        ]);

        if($validator->fails()){
            return response()->json([
            	'status' => 'bad request',
            	'message' => 'some field are not valid',
            	'data' => $validator->errors()
            ], 400);
        }

        $input = $request->only('name', 'email', 'password');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        // $success['token'] = $user->createToken('MyApp')->accessToken;
        // $success['name'] = $user->name;
        return response()->json([
        	'status' => 'success',
        	'message' => 'register success',
        	'data' => []
        	], 200);
    }
}
