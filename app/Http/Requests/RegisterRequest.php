<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\GeneralTrait;

class RegisterRequest extends FormRequest
{
       use GeneralTrait;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|string|alpha_dash|max:50',
            'email' =>'required|email|unique:users',
            'password' =>'required|min:8|max:50|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'image' =>'required|image|max:1024|mimes:jpg,png',
        ];
    }
}
