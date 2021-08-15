<?php

namespace App\Http\Requests;

use App\Models\RejaBeshdarboyan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRejaBeshdarboyanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('reja_beshdarboyan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:reja_beshdarboyans,id',
        ];
    }
}
