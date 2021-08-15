<?php

namespace App\Http\Requests;

use App\Models\Kandid;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreKandidRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('kandid_create');
    }

    public function rules()
    {
        return [
            'nav' => [
                'string',
                'required',
                'unique:kandids',
            ],
            'jimara_kandidi' => [
                'string',
                'required',
                'unique:kandids',
            ],
            'extra' => [
                'string',
                'nullable',
            ],
        ];
    }
}
