<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "visitee" => "required",
            "destination" => "required",
            "purpose" => "required",
            "phone_number" => "required",
            "duration" => "required",
            "guardian" => "required",
            "answer" => "required" ,
        ];
    }
}
