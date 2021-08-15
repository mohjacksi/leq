@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.leq.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.leqs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.leq.fields.id') }}
                        </th>
                        <td>
                            {{ $leq->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leq.fields.layene_siyasi') }}
                        </th>
                        <td>
                            {{ $leq->layene_siyasi->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leq.fields.name') }}
                        </th>
                        <td>
                            {{ $leq->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leq.fields.leq_code') }}
                        </th>
                        <td>
                            {{ $leq->leq_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.leq.fields.jimara_dengderan') }}
                        </th>
                        <td>
                            {{ $leq->jimara_dengderan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.leqs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection