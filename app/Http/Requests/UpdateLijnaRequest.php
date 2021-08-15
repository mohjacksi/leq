<?php

namespace App\Http\Requests;

use App\Models\Lijna;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLijnaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lijna_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:lijnas,name,' . request()->route('lijna')->id,
            ],
            'lijna_code' => [
                'string',
                'required',
                'unique:lijnas,lijna_code,' . request()->route('lijna')->id,
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
