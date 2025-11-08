<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFasilitasRequest extends FormRequest
{
public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'judul_fasilitas' => 'required|string|max:255',
            'isi_fasilitas' => 'required|string',
            'foto_fasilitas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_fasilitas' => 'required|date',
        ];
    }
}
