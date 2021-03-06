<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LessonEditFormRequest extends Request
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
            'subject_id' => 'required',
            'package_id' => 'required',
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'lesson_image' => 'image|max:1999',
            'status' => 'required'
        ];
    }
}
