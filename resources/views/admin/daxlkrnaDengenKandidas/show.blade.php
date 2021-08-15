@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.daxlkrnaDengenKandida.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.daxlkrna-dengen-kandidas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.id') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.leq') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.lijna') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->bingeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.westgeh') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->westgeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.layenesiyasi') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->layenesiyasi->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_kandidi') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->jimara_kandidi->jimara_kandidi ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_dengan') }}
                        </th>
                        <td>
                            {{ $daxlkrnaDengenKandida->jimara_dengan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.weene') }}
                        </th>
                        <td>
                            @foreach($daxlkrnaDengenKandida->weene as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.daxlkrnaDengenKandida.fields.file') }}
                        </th>
                        <td>
                            @foreach($daxlkrnaDengenKandida->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-primary btn-lg btn-block" href="{{ route('admin.daxlkrna-dengen-kandidas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection