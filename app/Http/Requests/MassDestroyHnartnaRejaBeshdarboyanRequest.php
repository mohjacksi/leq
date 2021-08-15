<?php

namespace App\Http\Requests;

use App\Models\HnartnaRejaBeshdarboyan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHnartnaRejaBeshdarboyanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hnartna_reja_beshdarboyans,id',
        ];
    }
}
