<?php

namespace App\Http\Requests;

use App\Models\Pasien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePasienRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('pasien_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'gender' => [
                'string',
                'nullable',
            ],
            'umur' => [
                'nullable',
                'string',
            ],
            'alamat' => [
                'nullable',
                'string',
            ],
        ];
    }
}
