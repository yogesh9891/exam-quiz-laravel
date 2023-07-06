<?php

namespace App\Http\Requests\Paper;

use Illuminate\Foundation\Http\FormRequest;

class SavePaper2Request extends FormRequest
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
            'template_id'=>['required'],
            'name'=>['required'],
            'defination_heading'=>['required'],
            'defination_decription'=>['required'],
            'word_heading'=>['required'],
            'word_decription'=>['required'],
            'example_heading'=>['required'],
            'example_decription'=>['required'],
        ];
    }
}
