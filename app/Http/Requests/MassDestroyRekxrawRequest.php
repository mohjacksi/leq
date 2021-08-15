<?php

namespace App\Http\Requests;

use App\Models\Rekxraw;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyRekxrawRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('rekxraw_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:rekxraws,id',
        ];
    }
}
