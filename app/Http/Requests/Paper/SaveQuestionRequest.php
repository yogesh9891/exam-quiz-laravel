<?php

namespace App\Http\Requests\Paper;

use Illuminate\Foundation\Http\FormRequest;

class SaveQuestionRequest extends FormRequest
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
           'template_id' => 'required|integer',
           'instruction' => 'required|string|max:255',
           'marks' => 'required|numeric',
           "question"    => 'required|array|min:5',
           'question.*' => 'required|string|max:255', 
           "answer_option"    => 'required|array',
           'answer_option.*' => 'required', 
           "explaintion"    => 'required|array',
           'explaintion.*' => 'required',
            "option_1"    => 'required|array',
           'option_1.*' => 'required',
            "option_2"    => 'required|array',
           'option_2.*' => 'required',   
             "option_3"    => 'required|array',
           'option_3.*' => 'required',
           "option_4"    => 'required|array',
           'option_4.*' => 'required',

    
        
        ];
    }
}
