@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.layenetsiyasi.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.layenetsiyasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.id') }}
                        </th>
                        <td>
                            {{ $layenetsiyasi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.name') }}
                        </th>
                        <td>
                            {{ $layenetsiyasi->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.code_siyasi') }}
                        </th>
                        <td>
                            {{ $layenetsiyasi->code_siyasi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.ala') }}
                        </th>
                        <td>
                            @foreach($layenetsiyasi->ala as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.jimara_kandida') }}
                        </th>
                        <td>
                            {{ $layenetsiyasi->jimara_kandida }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.layenetsiyasi.fields.extra') }}
                        </th>
                        <td>
                            {{ $layenetsiyasi->extra }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.layenetsiyasis.index') }}">
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
            <a class="nav-link" href="#layene_siyasi_kandids" role="tab" data-toggle="tab">
                {{ trans('cruds.kandid.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#layene_siyasi_dengen_layenetsiyasis" role="tab" data-toggle="tab">
                {{ trans('cruds.dengenLayenetsiyasi.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#layene_siyasi_leqs" role="tab" data-toggle="tab">
                {{ trans('cruds.leq.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="layene_siyasi_kandids">
            @includeIf('admin.layenetsiyasis.relationships.layeneSiyasiKandids', ['kandids' => $layenetsiyasi->layeneSiyasiKandids])
        </div>
        <div class="tab-pane" role="tabpanel" id="layene_siyasi_dengen_layenetsiyasis">
            @includeIf('admin.layenetsiyasis.relationships.layeneSiyasiDengenLayenetsiyasis', ['dengenLayenetsiyasis' => $layenetsiyasi->layeneSiyasiDengenLayenetsiyasis])
        </div>
        <div class="tab-pane" role="tabpanel" id="layene_siyasi_leqs">
            @includeIf('admin.layenetsiyasis.relationships.layeneSiyasiLeqs', ['leqs' => $layenetsiyasi->layeneSiyasiLeqs])
        </div>
    </div>
</div>

@endsection