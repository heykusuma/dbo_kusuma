<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
            'customer_id'    => 'required|exists:customers,id',
            'total_cost'     => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
			'customer_id.required'   => "Customer wajib diisi",
			'customer_id.exists'     => "Customer tidak ditemukan",
			'total_cost.required'    => "Total wajib diisi",
			'total_cost.numeric'     => "Total harus numerik",
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
