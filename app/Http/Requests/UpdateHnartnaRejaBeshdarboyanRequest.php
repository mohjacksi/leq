<?php

namespace App\Http\Requests;

use App\Models\HnartnaRejaBeshdarboyan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHnartnaRejaBeshdarboyanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hnartna_reja_beshdarboyan_edit');
    }

    public function rules()
    {
        return [
            'leq_id' => [
                'required',
                'integer',
            ],
            'lijna_id' => [
                'required',
                'integer',
            ],
            'bingeh_id' => [
                'required',
                'integer',
            ],
            'wistgeh_id' => [
                'required',
                'integer',
            ],
            'hejmar' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'dem' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
