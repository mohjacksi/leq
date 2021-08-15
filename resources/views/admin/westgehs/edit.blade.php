@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.westgeh.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.westgehs.update", [$westgeh->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.westgeh.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $westgeh->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.westgeh.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="westgeh_code">{{ trans('cruds.westgeh.fields.westgeh_code') }}</label>
                <input class="form-control {{ $errors->has('westgeh_code') ? 'is-invalid' : '' }}" type="text" name="westgeh_code" id="westgeh_code" value="{{ old('westgeh_code', $westgeh->westgeh_code) }}" required>
                @if($errors->has('westgeh_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('westgeh_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.westgeh.fields.westgeh_code_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="jimara_dengderan">{{ trans('cruds.westgeh.fields.jimara_dengderan') }}</label>
                <input class="form-control {{ $errors->has('jimara_dengderan') ? 'is-invalid' : '' }}" type="number" name="jimara_dengderan" id="jimara_dengderan" value="{{ old('jimara_dengderan', $westgeh->jimara_dengderan) }}" step="1" required>
                @if($errors->has('jimara_dengderan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_dengderan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.westgeh.fields.jimara_dengderan_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="bingeh_id">{{ trans('cruds.westgeh.fields.bingeh') }}</label>
                <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}" name="bingeh_id" id="bingeh_id" required>
                    @foreach($bingehs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bingeh_id') ? old('bingeh_id') : $westgeh->bingeh->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bingeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.westgeh.fields.bingeh_helper') }}</span>
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