<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
  
       return[
        // 'title'=>'required|alpha_num:ascii|unique:categories,title',        
         'title'=>'required|regex:/^[a-zA-Z0-9\s]+$/u',  
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
     'title.required'=>'The title is required',
     'title.alpha_num'=>'The title format must be alphabet',
      
   
    ];
    
}
}
