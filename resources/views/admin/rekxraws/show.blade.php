@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rekxraw.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.rekxraws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rekxraw.fields.id') }}
                        </th>
                        <td>
                            {{ $rekxraw->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rekxraw.fields.name') }}
                        </th>
                        <td>
                            {{ $rekxraw->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rekxraw.fields.code_rekxraw') }}
                        </th>
                        <td>
                            {{ $rekxraw->code_rekxraw }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rekxraw.fields.lijna') }}
                        </th>
                        <td>
                            {{ $rekxraw->lijna->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.rekxraws.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection