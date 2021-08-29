<?php

namespace App\Http\Requests;

use App\Models\Time;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTimeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('time_edit');
    }

    public function rules()
    {
        return [
            'time' => [
                'string',
                'required',
                'unique:times,time,' . request()->route('time')->id,
            ],
        ];
    }
}
