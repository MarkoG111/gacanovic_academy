<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseRequest extends FormRequest
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
            'courseName' => 'required|string',
            'coursePrice' => 'required|min:1|numeric',
            'courseHours' => 'required|min:1|numeric',
            'courseImage' => 'required|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'category' => 'exists:category,id_category',
            'topicsChb' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'courseName.required' => 'Course name is required.',
            'coursePrice.required' => 'Price is required.',
            'coursePrice.numeric' => 'Price must be integer',
            'courseHours.required' => 'Total Hours is required.',
            'courseHours.numeric' => 'Total Hours must be integer.',
            'courseImage.required' => 'Image is required.',
            'courseImage.image' => 'File must be image format.',
            'courseImage.max' => 'Image size is 8000kb maximum.',
            'category.exists' => 'You must choose category.',
            'topicsChb.required' => 'You must choose topic.',
        ];
    }
}
