<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;

class SaveSchoolTeacher extends FormRequest
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
           
        ];
    }
}
