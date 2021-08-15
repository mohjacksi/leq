<?php

namespace App\Http\Requests;

use App\Models\Layenetsiyasi;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLayenetsiyasiRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('layenetsiyasi_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:layenetsiyasis,name,' . request()->route('layenetsiyasi')->id,
            ],
            'code_siyasi' => [
                'string',
                'required',
            ],
            'jimara_kandida' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'extra' => [
                'string',
                'nullable',
            ],
        ];
    }
}
