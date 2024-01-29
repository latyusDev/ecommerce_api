<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $userDetails = $request->only(['name','email','password','image','phone_number',
                                        'first_name','last_name','role']);
        $userAddress = $request->except(['name','email','password','image','phone_number',
                                        'first_name','last_name','role']);
        $userDetails['image'] = asset('/storage/'.$request->file('image')->store('images','public'));
        $user = User::create($userDetails);
        $userAddress['user_id'] = $user->id;
        $userAddress['state'] = 'hhh';
        Address::create($userAddress);
        $token = $user->createToken('latyusDev')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function login(UserLoginRequest $request)
    {
        $userDetail = $request->only(['email','password']);
        $user = User::whereEmail($userDetail['email'])->first();
        if(!$user || Hash::check($user->password,$userDetail['password']))
        {
            return response([
                'message'=>'User credentials not found'
            ]);
        };
        $token = $user->createToken('latyus')->plainTextToken;
        return response([
            'user'=>$user,
            'token'=>$token
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'You are logged out'
        ]);    
    }

   
}
