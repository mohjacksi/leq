@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lijna.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.lijnas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.lijna.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lijna.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="lijna_code">{{ trans('cruds.lijna.fields.lijna_code') }}</label>
                <input class="form-control {{ $errors->has('lijna_code') ? 'is-invalid' : '' }}" type="text" name="lijna_code" id="lijna_code" value="{{ old('lijna_code', '') }}" required>
                @if($errors->has('lijna_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lijna.fields.lijna_code_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="leq_id">{{ trans('cruds.lijna.fields.leq') }}</label>
                <select class="form-control select2 {{ $errors->has('leq') ? 'is-invalid' : '' }}" name="leq_id" id="leq_id">
                    @foreach($leqs as $id => $entry)
                        <option value="{{ $id }}" {{ old('leq_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('leq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lijna.fields.leq_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="jimara_dengderan">{{ trans('cruds.lijna.fields.jimara_dengderan') }}</label>
                <input class="form-control {{ $errors->has('jimara_dengderan') ? 'is-invalid' : '' }}" type="number" name="jimara_dengderan" id="jimara_dengderan" value="{{ old('jimara_dengderan', '') }}" step="1">
                @if($errors->has('jimara_dengderan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_dengderan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lijna.fields.jimara_dengderan_helper') }}</span>
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