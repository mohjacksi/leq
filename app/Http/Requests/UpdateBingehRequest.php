<?php

namespace App\Http\Requests;

use App\Models\Bingeh;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBingehRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('bingeh_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:bingehs,name,' . request()->route('bingeh')->id,
            ],
            'bingeh_code' => [
                'string',
                'required',
                'unique:bingehs,bingeh_code,' . request()->route('bingeh')->id,
            ],
            'jimara_dengderan' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'lijna_id' => [
                'required',
                'integer',
            ],
            'jimara_rekxistiya' => [
                'string',
                'nullable',
            ],
        ];
    }
}
