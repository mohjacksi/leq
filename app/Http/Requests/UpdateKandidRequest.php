<?php

namespace App\Http\Requests;

use App\Models\Kandid;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateKandidRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kandid_edit');
    }

    public function rules()
    {
        return [
            'nav' => [
                'string',
                'required',
                'unique:kandids,nav,' . request()->route('kandid')->id,
            ],
            'jimara_kandidi' => [
                'string',
                'required',
                'unique:kandids,jimara_kandidi,' . request()->route('kandid')->id,
            ],
            'extra' => [
                'string',
                'nullable',
            ],
        ];
    }
}
