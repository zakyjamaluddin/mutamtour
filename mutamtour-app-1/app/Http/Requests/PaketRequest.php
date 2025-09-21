<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jenis' => 'required|in:Haji,Umroh',
            'nama' => 'required|string|max:255',
            'durasi' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'jenis.required' => 'Jenis paket harus diisi.',
            'jenis.in' => 'Jenis paket harus Haji atau Umroh.',
            'nama.required' => 'Nama paket harus diisi.',
            'nama.string' => 'Nama paket harus berupa teks.',
            'nama.max' => 'Nama paket tidak boleh lebih dari 255 karakter.',
            'durasi.required' => 'Durasi paket harus diisi.',
            'durasi.integer' => 'Durasi paket harus berupa angka.',
            'durasi.min' => 'Durasi paket harus minimal 1 hari.',
        ];
    }
}