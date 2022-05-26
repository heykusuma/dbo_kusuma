<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthRequest extends FormRequest
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
        return [
            'email'    => 'required|email|exists:users,email',
            'password' => 'required|string|min:6'
        ];
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
			'email.required'    => "Email wajib diisi",
			'email.exists'      => "Email belum terdaftar",
			'email.email'       => "Format email tidak valid",
			'password.required' => "Password wajib diisi",
			'password.min'      => "Password minimal 6 karakter",
		];
    }

    public function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => $validator->errors()->all()
        ], 422));

    }
}
