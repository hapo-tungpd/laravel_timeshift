<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "day" => "required|date",
            "today" => "required",
            "tomorrow" => "required",
            "problem" => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "day.required" => "The date has rerequired",
            "today.required" => "The Today time has rerequired",
            "tomorrow.required" => "The Tomorrow time has rerequired",
            "problem.required" => "The Problem has rerequired",
        ];
    }
}
