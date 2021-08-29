<?php

namespace App\Http\Requests;

use App\Models\Time;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreTimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('time_create');
    }

    public function rules()
    {
        return [
            'time' => [
                'string',
                'required',
                'unique:times',
            ],
        ];
    }
}
