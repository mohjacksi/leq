@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hnartnaDengan.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.hnartna-dengans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.id') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.dem') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->dem }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.leq') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.lijna') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->bingeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.wistgeh') }}
                        </th>
                        <td>
                            {{ $hnartnaDengan->wistgeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.wene') }}
                        </th>
                        <td>
                            @foreach($hnartnaDengan->wene as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaDengan.fields.tebini') }}
                        </th>
                        <td>
                            {!! $hnartnaDengan->tebini !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.hnartna-dengans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection