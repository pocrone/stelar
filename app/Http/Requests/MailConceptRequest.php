<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailConceptRequest extends FormRequest
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
            'mail_concept' => 'required'
        ];
    }

    public function message()
    {
        return [
            'mail_concept.required' => 'Data yang dimasukkan tidak bisa kosong'
        ];
    }
}
