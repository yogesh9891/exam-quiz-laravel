<?php

namespace App\Http\Requests\Paper;
// /N(Xt-ig4y1o}
use Illuminate\Foundation\Http\FormRequest;

class SavePaperRequest extends FormRequest
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


        $rules =  [
             'title' => ['required', 'string', 'max:255'],
            'b_title' => ['required', 'string', 'max:255'],
            'b_sub_title' => ['required', 'string', 'max:255'],
            'subject_id'=>['required'],
            'category_id'=>['required'],
            'class_id'=>['required'],
            'board_id'=>['required'],
            'q_type'=>['required'],
            'chapter_title' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'numeric','digits:13'],
            'chapter_source' => ['required', 'numeric'],
            'publication_year' => ['required', 'string', 'max:255','date_format:Y'],
        ];

        return $rules;
    }

      public function messages()
    {
        return [
            'b_title.required' => 'The Book title  is required.',
            'b_sub_title.required' => 'The Book sub title  is required.',
            'subject_id.required' => 'The Subject is required.',
            'category_id.required' => 'The Category is required.',
           
        ];
    }
}
