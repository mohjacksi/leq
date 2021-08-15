@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.westgeh.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.westgehs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.westgeh.fields.id') }}
                        </th>
                        <td>
                            {{ $westgeh->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.westgeh.fields.name') }}
                        </th>
                        <td>
                            {{ $westgeh->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.westgeh.fields.westgeh_code') }}
                        </th>
                        <td>
                            {{ $westgeh->westgeh_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.westgeh.fields.jimara_dengderan') }}
                        </th>
                        <td>
                            {{ $westgeh->jimara_dengderan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.westgeh.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $westgeh->bingeh->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.westgehs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#wistgeh_hnartna_dengans" role="tab" data-toggle="tab">
                {{ trans('cruds.hnartnaDengan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="wistgeh_hnartna_dengans">
            @includeIf('admin.westgehs.relationships.wistgehHnartnaDengans', ['hnartnaDengans' => $westgeh->wistgehHnartnaDengans])
        </div>
    </div>
</div>

@endsection