<?php

namespace App\Http\Requests\Admin\Media;

use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
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
       $maxlength=100;
       $maxlengthDesc=500;
       $minMobileLength=10;
       $maxMobileLength=15;
       return[
                 
         'title'=>'nullable|between:0,'.$maxlength,
         'caption'=>'nullable|between:0,'.$maxlength,         
         'desc'=>'nullable|between:0,'.$maxlengthDesc,  
         'photo'=>'file|image',       
       ];   
    
    }
    /**
 * Get the error messages for the defined validation rules.
 *
 * @return array<string, string>
 */
public function messages(): array
{
   $maxlength=100;
   $maxlengthDesc=500;

   return[
    'title.between'=>'Title charachters must be les than '.$maxlength,
    'caption.between'=>'caption charachters must be les than '.$maxlength,
    'desc.between'=>'desc charachters must be les than '.$maxlengthDesc,

    ];
    
}
}
