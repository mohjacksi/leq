<?php

namespace App\Http\Requests;

use App\Models\DengenLayenetsiyasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreDengenLayenetsiyasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('dengen_layenetsiyasi_create');
    }

    public function rules()
    {
        return [
            'leq_id' => [
                'required',
                'integer',
            ],
            'lijna_id' => [
                'required',
                'integer',
            ],
            'bingeh_id' => [
                'required',
                'integer',
            ],
            'westgeh_id' => [
                'required',
                'integer',
            ],
            'layene_siyasi_id' => [
                'required',
                'integer',
            ],
            'jimara_dengan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'extra_1' => [
                'string',
                'nullable',
            ],
            'extra_2' => [
                'string',
                'nullable',
            ],
        ];
    }
}
