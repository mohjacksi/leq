@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.dengenLayenetsiyasi.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.dengen-layenetsiyasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.id') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.leq') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.lijna') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->bingeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.westgeh') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->westgeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.layene_siyasi') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->layene_siyasi->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.jimara_dengan') }}
                        </th>
                        <td>
                            {{ $dengenLayenetsiyasi->jimara_dengan }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.weene') }}
                        </th>
                        <td>
                            @foreach($dengenLayenetsiyasi->weene as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.dengenLayenetsiyasi.fields.file') }}
                        </th>
                        <td>
                            @foreach($dengenLayenetsiyasi->file as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.dengen-layenetsiyasis.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection