<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JamaahRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'kantor_id' => 'required|exists:kantors,id',
            'tanggal_lahir' => 'nullable|date',
            'nomor_wa' => 'nullable|string|max:15',
            'group_id' => 'nullable|exists:groups,id',
            'vaksin_meningitis' => 'boolean',
            'vaksin_polio' => 'boolean',
            'passport' => 'boolean',
            'status_pembayaran' => 'boolean',
        ];
    }
}