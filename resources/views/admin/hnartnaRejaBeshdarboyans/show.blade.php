@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.hnartnaRejaBeshdarboyan.title') }}
    </div>

    <div class="card-body text-info">
        <div class="form-group col-md-6">
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.hnartna-reja-beshdarboyans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.id') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.leq') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->leq->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.lijna') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->lijna->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.bingeh') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->bingeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wistgeh') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->wistgeh->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.hejmar') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->hejmar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.dem') }}
                        </th>
                        <td>
                            {{ $hnartnaRejaBeshdarboyan->dem }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wene') }}
                        </th>
                        <td>
                            @foreach($hnartnaRejaBeshdarboyan->wene as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.hnartnaRejaBeshdarboyan.fields.tebini') }}
                        </th>
                        <td>
                            {!! $hnartnaRejaBeshdarboyan->tebini !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group col-md-6">
                <a class="btn btn-default" href="{{ route('admin.hnartna-reja-beshdarboyans.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection