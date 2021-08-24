<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

class TaskRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            "task_name" => "required",
            "description"=> "nullable",
            "genre_id" => "required|integer|min:1|max:10",
            "difficulty_id" => "required|integer|min:1|max:3"
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