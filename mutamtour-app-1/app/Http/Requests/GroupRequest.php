<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'paket_id' => 'required|exists:pakets,id',
            'tanggal' => 'nullable|date',
            'bulan' => 'nullable|integer|min:1|max:12',
            'tahun' => 'nullable|integer|min:2023|max:2099',
            'keterangan' => 'nullable|string|max:255',
            'total_seat' => 'required|integer|min:1',
            'vendor' => 'nullable|string|max:255',
            'tour_leader' => 'nullable|string|max:255',
        ];
    }
}