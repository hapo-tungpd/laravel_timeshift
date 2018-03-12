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
            "day" => "required",
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
            "day.required" => "The date is not null!",
            "today.required" => "Today can not be empty!",
            "tomorrow.required" => "Tomorrow can not be empty!",
            "problem.required" => "Problem can not be empty!",
        ];
    }
}
