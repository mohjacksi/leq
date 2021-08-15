<?php

namespace App\Http\Requests;

use App\Models\Westgeh;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWestgehRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('westgeh_edit');
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
                'unique:westgehs,westgeh_code,' . request()->route('westgeh')->id,
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
