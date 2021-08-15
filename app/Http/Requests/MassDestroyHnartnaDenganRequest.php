<?php

namespace App\Http\Requests;

use App\Models\HnartnaDengan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHnartnaDenganRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('hnartna_dengan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:hnartna_dengans,id',
        ];
    }
}
