<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeminjamanRequest extends FormRequest
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
            'wkt_pinjam' => 'required|date',
            'wkt_selesai' => 'required|date|after_or_equal:wkt_pinjam',
            'keterangan' => 'required',
        ];
    }
}
