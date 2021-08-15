@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.leq.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.leqs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="layene_siyasi_id">{{ trans('cruds.leq.fields.layene_siyasi') }}</label>
                <select class="form-control select2 {{ $errors->has('layene_siyasi') ? 'is-invalid' : '' }}" name="layene_siyasi_id" id="layene_siyasi_id" required>
                    @foreach($layene_siyasis as $id => $entry)
                        <option value="{{ $id }}" {{ old('layene_siyasi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('layene_siyasi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('layene_siyasi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.leq.fields.layene_siyasi_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.leq.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.leq.fields.name_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="leq_code">{{ trans('cruds.leq.fields.leq_code') }}</label>
                <input class="form-control {{ $errors->has('leq_code') ? 'is-invalid' : '' }}" type="text" name="leq_code" id="leq_code" value="{{ old('leq_code', '') }}" required>
                @if($errors->has('leq_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leq_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.leq.fields.leq_code_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="jimara_dengderan">{{ trans('cruds.leq.fields.jimara_dengderan') }}</label>
                <input class="form-control {{ $errors->has('jimara_dengderan') ? 'is-invalid' : '' }}" type="number" name="jimara_dengderan" id="jimara_dengderan" value="{{ old('jimara_dengderan', '') }}" step="1">
                @if($errors->has('jimara_dengderan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_dengderan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.leq.fields.jimara_dengderan_helper') }}</span>
            </div>
            </div>
            <div class="form-group center">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection