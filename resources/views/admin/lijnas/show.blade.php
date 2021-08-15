@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lijna.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.lijnas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lijna.fields.id') }}
                        </th>
                        <td>
                            {{ $lijna->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lijna.fields.name') }}
                        </th>
                        <td>
                            {{ $lijna->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lijna.fields.lijna_code') }}
                        </th>
                        <td>
                            {{ $lijna->lijna_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lijna.fields.leq') }}
                        </th>
                        <td>
                            {{ $lijna->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lijna.fields.jimara_dengderan') }}
                        </th>
                        <td>
                            {{ $lijna->jimara_dengderan }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.lijnas.index') }}">
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
            <a class="nav-link" href="#lijna_rekxraws" role="tab" data-toggle="tab">
                {{ trans('cruds.rekxraw.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lijna_hnartna_dengans" role="tab" data-toggle="tab">
                {{ trans('cruds.hnartnaDengan.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="lijna_rekxraws">
            @includeIf('admin.lijnas.relationships.lijnaRekxraws', ['rekxraws' => $lijna->lijnaRekxraws])
        </div>
        <div class="tab-pane" role="tabpanel" id="lijna_hnartna_dengans">
            @includeIf('admin.lijnas.relationships.lijnaHnartnaDengans', ['hnartnaDengans' => $lijna->lijnaHnartnaDengans])
        </div>
    </div>
</div>

@endsection