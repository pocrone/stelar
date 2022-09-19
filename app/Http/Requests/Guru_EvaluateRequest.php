<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Guru_EvaluateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "value" => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'value.required'    => 'Judul tidak boleh kosong',
        ];
    }
}
