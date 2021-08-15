<?php

namespace App\Http\Requests;

use App\Models\Leq;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLeqRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('leq_edit');
    }

    public function rules()
    {
        return [
            'layene_siyasi_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
                'unique:leqs,name,' . request()->route('leq')->id,
            ],
            'leq_code' => [
                'string',
                'required',
                'unique:leqs,leq_code,' . request()->route('leq')->id,
            ],
            'jimara_dengderan' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
