<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KantorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama' => 'required|string|max:255',
        ];
    }
}