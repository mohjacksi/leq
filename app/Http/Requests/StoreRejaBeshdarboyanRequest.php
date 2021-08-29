<?php

namespace App\Http\Requests;

use App\Models\RejaBeshdarboyan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreRejaBeshdarboyanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('reja_beshdarboyan_create');
    }

    public function rules()
    {
        //lijna_id
        //time_id
        return [
            'jimara_beshdarboyan' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],

            // 'lijna_id' => [
            //     'required',
            //      Rule::unique('reja_beshdarboyan')->where(function ($query) use($lijna_id,$time_id) {
            //        return $query->where('lijna_id', $lijna_id)->where('time_id', $time_id);
            //      })
            // ],
        ];
    }
}
