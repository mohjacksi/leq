@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userType.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.user-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.id') }}
                        </th>
                        <td>
                            {{ $userType->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.name') }}
                        </th>
                        <td>
                            {{ $userType->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userType.fields.code') }}
                        </th>
                        <td>
                            {{ $userType->code }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.user-types.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection