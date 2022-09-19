<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Guru_ClassroomRequest extends FormRequest
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
            "class_name" => ['required']
        ];
    }
    public function messages()
    {
        return [
            'class_name.required'    => 'Nama kelas tidak boleh kosong',
        ];
    }
}
