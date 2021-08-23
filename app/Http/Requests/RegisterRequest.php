<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class RegisterRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'user_name' => 'required|max::255',
            'email' => 'required|email|unique:users|max::255',
            'password' => 'required|max::255'
        ];
    }

    public function failedValidation(Validator $validator){
        $res = response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'errors' => $validator->errors(),
        ], Response::HTTP_BAD_REQUEST);
        throw new HttpResponseException($res);
    }
}