<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|min:3',
            'role' => 'required',
            'divisi' => 'required',
            'nik' => 'required|alpha_num|min:3|max:20',
            'no_hp' => 'required|alpha_num',
            'email' => 'required|email',
            'gender' => 'required',
        ];
    }
}
