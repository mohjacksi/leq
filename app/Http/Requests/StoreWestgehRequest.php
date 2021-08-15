<?php

namespace App\Http\Requests;

use App\Models\Westgeh;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreWestgehRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('westgeh_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'westgeh_code' => [
                'string',
                'required',
                'unique:westgehs',
            ],
            'jimara_dengderan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'bingeh_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
