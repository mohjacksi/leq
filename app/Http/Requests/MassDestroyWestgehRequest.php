<?php

namespace App\Http\Requests;

use App\Models\Westgeh;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWestgehRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('westgeh_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:westgehs,id',
        ];
    }
}
