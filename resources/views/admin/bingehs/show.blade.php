@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bingeh.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.bingehs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.id') }}
                        </th>
                        <td>
                            {{ $bingeh->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.name') }}
                        </th>
                        <td>
                            {{ $bingeh->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.bingeh_code') }}
                        </th>
                        <td>
                            {{ $bingeh->bingeh_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.jimara_dengderan') }}
                        </th>
                        <td>
                            {{ $bingeh->jimara_dengderan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.lijna') }}
                        </th>
                        <td>
                            {{ $bingeh->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.rekxraw') }}
                        </th>
                        <td>
                            {{ $bingeh->rekxraw->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bingeh.fields.jimara_rekxistiya') }}
                        </th>
                        <td>
                            {{ $bingeh->jimara_rekxistiya }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.bingehs.index') }}">
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
            <a class="nav-link" href="#bingeh_hnartna_dengans" role="tab" data-toggle="tab">
                {{ trans('cruds.hnartnaDengan.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#bingeh_daxlkrna_dengen_kandidas" role="tab" data-toggle="tab">
                {{ trans('cruds.daxlkrnaDengenKandida.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="bingeh_hnartna_dengans">
            @includeIf('admin.bingehs.relationships.bingehHnartnaDengans', ['hnartnaDengans' => $bingeh->bingehHnartnaDengans])
        </div>
        <div class="tab-pane" role="tabpanel" id="bingeh_daxlkrna_dengen_kandidas">
            @includeIf('admin.bingehs.relationships.bingehDaxlkrnaDengenKandidas', ['daxlkrnaDengenKandidas' => $bingeh->bingehDaxlkrnaDengenKandidas])
        </div>
    </div>
</div>

@endsection