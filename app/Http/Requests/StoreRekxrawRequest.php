<?php

namespace App\Http\Requests;

use App\Models\Rekxraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRekxrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rekxraw_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:rekxraws',
            ],
            'code_rekxraw' => [
                'string',
                'required',
                'unique:rekxraws',
            ],
            'lijna_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
