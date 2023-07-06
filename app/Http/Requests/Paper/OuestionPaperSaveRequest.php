<?php

namespace App\Http\Requests\Paper;

use Illuminate\Foundation\Http\FormRequest;

class OuestionPaperSaveRequest extends FormRequest
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
            'template_id'=>'required',
            'paper_id'=>'required',
            "question_id"    => 'required|array|min:5',
           'question_id.*' => 'required|string|max:255', 
        ];
    }

         public function messages()
    {
        return [
            'question_id.array' => 'Minimum 5 question are required',
        
           
        ];
    }
}
