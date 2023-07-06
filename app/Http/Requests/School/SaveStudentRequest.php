<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;

class SaveStudentRequest extends FormRequest
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
        
        $rules = [
            'name'=>'required|string|max:255',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => 'confirmed',
            'parent_name'=>'required|string|max:255',
            'parent_relation'=>'required|string|max:255',
            'parent_email'=>'required|string|max:255',
            
            'class_id'=>'required|numeric',
            'section_id'=>'required|numeric',
            'admission_id'=>'required|alpha_num',
            'roll_no'=>'required|alpha_num',

        ];

          if ($this->method() == 'POST') {
          $rules['email'] ='required|string|email|max:255|unique:users';
          $rules['password'] ='required|string|min:8|confirmed';
          $rules['phone'] ='required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:users';

        }

        return $rules;
       
    }

      public function messages()
    {
        return [
            'phone.regex' => 'The phone number is invalid.',
            'class_id.numeric' => 'Please select class.',
            'section_id.numeric' => 'Please select section.',
           
        ];
    }
}
