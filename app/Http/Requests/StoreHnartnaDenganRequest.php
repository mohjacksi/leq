<?php

namespace App\Http\Requests;

use App\Models\HnartnaDengan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHnartnaDenganRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hnartna_dengan_create');
    }

    public function rules()
    {
        return [
            'dem' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
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
        ];
    }
}
