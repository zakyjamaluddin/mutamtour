<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembayaranRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jamaah_id' => 'required|exists:jamaah,id',
            'jenis' => 'required|in:DP,Vaksin Meningitis,Vaksin Polio,Passport,Biaya Umroh,Lainnya',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'jamaah_id.required' => 'Jamaah ID is required.',
            'jamaah_id.exists' => 'The selected Jamaah ID is invalid.',
            'jenis.required' => 'Jenis pembayaran is required.',
            'jenis.in' => 'Jenis pembayaran must be one of the following: DP, Vaksin Meningitis, Vaksin Polio, Passport, Biaya Umroh, Lainnya.',
            'jumlah.required' => 'Jumlah is required.',
            'jumlah.integer' => 'Jumlah must be an integer.',
            'jumlah.min' => 'Jumlah must be at least 1.',
            'keterangan.string' => 'Keterangan must be a string.',
            'keterangan.max' => 'Keterangan may not be greater than 255 characters.',
        ];
    }
}