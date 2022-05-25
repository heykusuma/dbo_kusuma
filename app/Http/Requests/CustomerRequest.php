<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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
        $reqStr = 'required|string';
        return [
            'first_name'    => $reqStr,
            'last_name'     => $reqStr,
            'address'       => $reqStr,
            'phone_number'  => 'required|regex:/[0-9]{9}/|digits_between:10,15'
        ];
    }

    public function messages()
    {
        return [
			'first_name.required'           => "Nama depan wajib diisi",
			'last_name.required'            => "Nama belakang diisi",
			'address.required'              => "Alamat wajib diisi",
			'phone_number.required'         => "Nomor Telpon wajib diisi",
			'phone_number.regex'            => "Format nomor telpon tidak valid",
			'phone_number.digits_between'   => "Nomor Telpon minimal 10 - 15 digit",
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
