<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrainingRequest extends FormRequest
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
            'vendor' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'qualification_id' => 'required|string',
            'course_id' => 'required|integer',
            'sponsor' => 'required|string|max:255',
            'resident' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
