<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class LoginController extends Controller{
    
    public function login(LoginRequest $request){
        $credentials = $request->validated();
        
        if (Auth::attempt($credentials)){
            $user = User::whereEmail($request->email)->first(); 
            //$user = Auth::user();
    
            $user->tokens()->delete();
            $token = $user->createToken("login:user{$user->id}")->plainTextToken;
    
            return response()->json([
                'result' => true,
                'token' => $token
            ], Response::HTTP_OK);
        }
        return response()->json([
            'result' => false,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}