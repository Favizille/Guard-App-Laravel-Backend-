<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardRequest extends FormRequest
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
            "start_date" => "required",
            "start_time" => "required",
            "end_date" => "required",
            "end_time" => "required",
        ];
    }
}
