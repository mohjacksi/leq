@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.rejaBeshdarboyan.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.reja-beshdarboyans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.id') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.leq') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.lijna') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->bingeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.demjimer') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->demjimer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.rejaBeshdarboyan.fields.jimara_beshdarboyan') }}
                        </th>
                        <td>
                            {{ $rejaBeshdarboyan->jimara_beshdarboyan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.reja-beshdarboyans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection