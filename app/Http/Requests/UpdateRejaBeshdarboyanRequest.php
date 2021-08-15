<?php

namespace App\Http\Requests;

use App\Models\RejaBeshdarboyan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateRejaBeshdarboyanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reja_beshdarboyan_edit');
    }

    public function rules()
    {
        return [
            'demjimer' => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'jimara_beshdarboyan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
