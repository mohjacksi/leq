@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.bingeh.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.bingehs.update", [$bingeh->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.bingeh.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $bingeh->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="bingeh_code">{{ trans('cruds.bingeh.fields.bingeh_code') }}</label>
                <input class="form-control {{ $errors->has('bingeh_code') ? 'is-invalid' : '' }}" type="text" name="bingeh_code" id="bingeh_code" value="{{ old('bingeh_code', $bingeh->bingeh_code) }}" required>
                @if($errors->has('bingeh_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.bingeh_code_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="jimara_dengderan">{{ trans('cruds.bingeh.fields.jimara_dengderan') }}</label>
                <input class="form-control {{ $errors->has('jimara_dengderan') ? 'is-invalid' : '' }}" type="number" name="jimara_dengderan" id="jimara_dengderan" value="{{ old('jimara_dengderan', $bingeh->jimara_dengderan) }}" step="1">
                @if($errors->has('jimara_dengderan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_dengderan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.jimara_dengderan_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="lijna_id">{{ trans('cruds.bingeh.fields.lijna') }}</label>
                <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}" name="lijna_id" id="lijna_id" required>
                    @foreach($lijnas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lijna_id') ? old('lijna_id') : $bingeh->lijna->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lijna'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.lijna_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rekxraw_id">{{ trans('cruds.bingeh.fields.rekxraw') }}</label>
                <select class="form-control select2 {{ $errors->has('rekxraw') ? 'is-invalid' : '' }}" name="rekxraw_id" id="rekxraw_id">
                    @foreach($rekxraws as $id => $entry)
                        <option value="{{ $id }}" {{ (old('rekxraw_id') ? old('rekxraw_id') : $bingeh->rekxraw->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rekxraw'))
                    <div class="invalid-feedback">
                        {{ $errors->first('rekxraw') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.rekxraw_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="jimara_rekxistiya">{{ trans('cruds.bingeh.fields.jimara_rekxistiya') }}</label>
                <input class="form-control {{ $errors->has('jimara_rekxistiya') ? 'is-invalid' : '' }}" type="text" name="jimara_rekxistiya" id="jimara_rekxistiya" value="{{ old('jimara_rekxistiya', $bingeh->jimara_rekxistiya) }}">
                @if($errors->has('jimara_rekxistiya'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_rekxistiya') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.bingeh.fields.jimara_rekxistiya_helper') }}</span>
            </div>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection