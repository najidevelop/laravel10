<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return[
             'title'=>'required',   
          //  'title'=>'required|regex:/^[a-zA-Z0-9\s]+$/u|unique:categories,title',   
            'slug'=>'unique:posts,slug',   
              //     'title'=>'required|alpha_num|unique:categories,title',      
          
            ]; 
    }
    public function messages(): array
{
   $maxlength=500;
   $minMobileLength=10;
   $maxMobileLength=15;
   return[
     'title.required'=>'The Title is required',
    // 'title.alpha_num'=>'The title format must be alphabet',
     'title.regex'=>'The Title format must be alphabet',
    // 'title.unique'=>'The Title is already exist',
     'slug.unique'=>'The Slug is already exist',
    ];
    
}
}
