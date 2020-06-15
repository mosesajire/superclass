<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseFormRequest extends Request
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
            'package_id' => 'required',
            'name' => 'required|min:3|unique:courses',
            'description' => 'required|min:3',
            'course_image' => 'image|max:1999',
            'status' => 'required'
        ];
    }
}
