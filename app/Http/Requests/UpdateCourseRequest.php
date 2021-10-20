<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'courseImage' => 'nullable|image|mimes:png,jpg,jpeg,gif,svg|max:2048',
            'category' => 'exists:category,id_category',
            'topicsChb' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'topicsChb.required' => 'You must choose topic.',
            'courseImage.image' => 'File must be image',
            'courseImage.max' => 'Image must be less than 2048 kb.',
            'category.exists' => 'You must choose category.'
        ];
    }
}
