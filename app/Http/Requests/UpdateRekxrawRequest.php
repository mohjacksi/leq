<?php

namespace App\Http\Requests;

use App\Models\Rekxraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRekxrawRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('rekxraw_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:rekxraws,name,' . request()->route('rekxraw')->id,
            ],
            'code_rekxraw' => [
                'string',
                'required',
                'unique:rekxraws,code_rekxraw,' . request()->route('rekxraw')->id,
            ],
            'lijna_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
