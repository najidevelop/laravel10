<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $maxlength=500;
      $minMobileLength=10;
      $maxMobileLength=15;
      return[
        'name'=>'required|alpha_num:ascii',
      
        'email'=>'required|email',
        'first_name'=>'nullable|alpha',    
        'last_name'=>'nullable|alpha',
        
       
        'address'=>'nullable|between:0,'.$maxlength,
        'country'=>'required',
        'city'=>'required|alpha_num',
        'mobile'=>'nullable|numeric|digits_between:'. $minMobileLength.','.$maxMobileLength,
        
        'phone'=>'nullable|numeric|digits_between:'. $minMobileLength.','.$maxMobileLength,
        'role'=>'required',         
   
      ];   
    
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
    $maxlength=500;
      $minMobileLength=10;
      $maxMobileLength=15;
      return[
        'name.required'=>'The name is required',
        'name.alpha_num'=>'The name format must be alphabet',
        
        'email.required'=>'Email is required',
        'email.email'=>'Valid Email  is required',
 
      
        'first_name.alpha'=>'first name format must be alphabet',
        'last_name.alpha'=>'last name format must be alphabet',
     
     
        'address.between'=>'address charachters must be les than '.$maxlength,
        'country.required'=>'country is required',
        'city.required'=>'city is required',
        'mobile.numeric'=>'mobile must contain only numbers',
        'mobile.digits_between'=>'mobile number must be between '. $minMobileLength.' and '.$maxMobileLength,
      
        'phone.numeric'=>'phone must contain only numbers',
        'phone.digits_between'=>'phone  number must be between '. $minMobileLength.' and '.$maxMobileLength,
        'role.required'=>'role is required',
       ];
}
}
