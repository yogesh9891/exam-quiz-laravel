<?php

namespace App\Http\Requests\School;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveSchoolRequest extends FormRequest
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

        $rules =   [
            'school_id' => ['string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [ 'string', 'email', 'max:255', ],
            'phone' => ['required'],
            'password' => ['confirmed'],
            // 'region' => ['required'],
            'school_group_id' => ['required'],
        ];

        if ($this->method() == 'POST') {
          
          $rules['school_id'] ='required|string|max:255|unique:users';
          $rules['email'] ='required|string|email|max:255|unique:users';
          $rules['password'] ='required|string|min:8|confirmed';

        }
       
       return $rules;
        
    }
}
