<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $req)
    {
        $users=$req->validate([
            'name'=>'required',
            'email'=>'required|email|',
            'password'=>'required|confirmed',
        ]); 
        $userCount = User::where('email', $req->email);
        if ($userCount->count()) {
            return Response(['message'=>'Login already exits'],409);
        } 
       // return response(['message'=>'Email Already exits'],403);
        
        $user = User::create([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password),
        ]);

        $token = $user->createToken('mytoken')->plainTextToken;
        return response([
                'user'=>$user,
                'token'=>$token
        ],201);

    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message'=>'Sucessfully Logged Out !!'
        ],201);
    }
    public function login(Request $req)
    {
        
        $req->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);   
        $user = User::where('email', $req->email)->first();

        if(!$user || !Hash::check($req->password,$user->password))
        {
            return response([
                'message'=>'The provided credentials are incorrect.'
            ],401);
        }
        $token = $user->createToken('mytoken')->plainTextToken;
        return response([
                'user'=>$user,
                'token'=>$token
        ],200);

    }
}
