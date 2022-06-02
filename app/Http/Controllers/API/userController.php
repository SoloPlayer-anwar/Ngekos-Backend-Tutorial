<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{

    public function register (Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'jenis_kelamin' => 'sometimes|nullable|string|max:255',
                'alamat' => 'sometimes|nullable|string',
                'kota' => 'sometimes|nullable|string',
                'phone' => 'sometimes|nullable|string',
                'latitude' => 'sometimes|nullable',
                'longitude' => 'sometimes|nullable',
            ]);


            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'phone' => $request->phone,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);


            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('AuthToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Register Success');
        }

        catch(Exception $error)
        {
            return ResponseFormatter::error([
                'message' => 'Register Failure',
                'error' => $error
            ], 'Register Failure', 404);
        }
    }

    public function login (Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);


            $credentials = request(['email', 'password']);

            if(!Auth::attempt($credentials))
            {
                return ResponseFormatter::error([
                    'message' => 'Token Failure',
                ], 'Token Failure', 404);
            }

            $user = User::where('email', $request->email)->first();

            if(!Hash::check($request->password, $user->password, []))
            {
                throw new \Exception('Password is Failure');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Login Success');
        }

        catch(Exception $error)
        {
            return ResponseFormatter::error([
                'message' => 'Login Failure',
                'error' => $error
            ], 'Login Failure', 404);
        }
    }

    public function getUser(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'User Berhasil di ambil');
    }

    public function logout (Request $request)
    {
        $token = $request->user()->currentAccessToken()->delete();
        return ResponseFormatter::success($token, 'Logout Success');
    }

    public function updateUser(Request $request)
    {
        $input = $request->all();
        $user = Auth::user();

        $user->update($input);
        return ResponseFormatter::success($user, 'Update User Success');
    }

    public function uploadAvatar(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();

        if(is_null($user))
        {
            return ResponseFormatter::error([
                'message' => 'User tidak ditemukan'
            ], 'User tidak ditemukan', 404);
        }

        $validate = Validator::make($data, [
            'avatar' => 'sometimes|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
        ]);


        if($validate->fails())
        {
            return ResponseFormatter::error([
                'message' => 'Validate Failure',
                'error' => $validate->errors()
            ], 'Validate Failure', 404);
        }


        if($request->hasFile('avatar'))
        {
            if($request->file('avatar')->isValid())
            {
                Storage::disk('upload')->delete($user->avatar);
                $avatar = $request->file('avatar');
                $extensions = $avatar->getClientOriginalExtension();
                $userAvatar = "user-avatar/".date('YmdHis').".".$extensions;
                $uploadPath = env('UPLOAD_PATH'). "/user-avatar";
                $request->file('avatar')->move($uploadPath, $userAvatar);
                $data['avatar'] = $userAvatar;
            }
        }

        $user->update($data);
        return ResponseFormatter::success(
            $user,
            'Upload Photo Success'
        );
    }
}
