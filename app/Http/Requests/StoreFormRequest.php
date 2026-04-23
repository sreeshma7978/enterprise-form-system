<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {        
        return true;
    }
   

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules()
{
    return [
        'title' => 'required|string',
        'fields' => 'required|array|min:1',

        'fields.*.label' => 'required|string',
        'fields.*.name' => 'required|string',
        'fields.*.type' => 'required|string',
    ];
}
}
