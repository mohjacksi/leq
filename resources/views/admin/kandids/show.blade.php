@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.kandid.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.kandids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.id') }}
                        </th>
                        <td>
                            {{ $kandid->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.nav') }}
                        </th>
                        <td>
                            {{ $kandid->nav }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.jimara_kandidi') }}
                        </th>
                        <td>
                            {{ $kandid->jimara_kandidi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.layene_siyasi') }}
                        </th>
                        <td>
                            {{ $kandid->layene_siyasi->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.ala') }}
                        </th>
                        <td>
                            @foreach($kandid->ala as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.wene') }}
                        </th>
                        <td>
                            @if($kandid->wene)
                                <a href="{{ $kandid->wene->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $kandid->wene->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.kandid.fields.extra') }}
                        </th>
                        <td>
                            {{ $kandid->extra }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.kandids.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection