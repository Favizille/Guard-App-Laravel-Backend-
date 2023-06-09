<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            "first_name" => "required",
            "last_name" => "required",
            "address" => "required",
            "phone_number" => "required",
            "NIN" => "required",
            "state_of_origin" => "required",
            "state_of_residence" => "required",
            "date_of_birth" => "required",
            // "image" => "required",
        ];
    }
}
