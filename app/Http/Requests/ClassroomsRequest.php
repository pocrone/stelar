<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassroomsRequest extends FormRequest
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
            'class_code' => ['required', 'min:5']
        ];
    }

    public function messages()
    {
        return [
            'class_code.required'    => 'Kode kamu yang kamu masukkan kosong atau tidak terisi',
            'class_code.min' => 'Masukkan minimal 5 karakter kode kelas'
        ];
    }
}
