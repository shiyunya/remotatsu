<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;

class RegisterController extends Controller{
    public function register(RegisterRequest $reqest){
        User::create([
            'user_name' => $reqest->user_name,
            'email' => $reqest->email,
            'password' => Hash::make($reqest->password),
        ]);

        return response()->json(['created' => 'true'], Response::HTTP_OK);
    }
}