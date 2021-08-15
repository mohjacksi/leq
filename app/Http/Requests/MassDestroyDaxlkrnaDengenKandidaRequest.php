<?php

namespace App\Http\Requests;

use App\Models\DaxlkrnaDengenKandida;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDaxlkrnaDengenKandidaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:daxlkrna_dengen_kandidas,id',
        ];
    }
}
