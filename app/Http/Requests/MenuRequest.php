<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 'admin') {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'price' => 'required',
            'menu_image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Menu name must be filled',
            'price.required' => 'Menu price must be filled',
            'menu_image.required' => 'Menu image must be filled'
        ];
    }
}
