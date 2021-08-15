@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.rekxraw.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.rekxraws.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.rekxraw.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rekxraw.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="code_rekxraw">{{ trans('cruds.rekxraw.fields.code_rekxraw') }}</label>
                <input class="form-control {{ $errors->has('code_rekxraw') ? 'is-invalid' : '' }}" type="text" name="code_rekxraw" id="code_rekxraw" value="{{ old('code_rekxraw', '') }}" required>
                @if($errors->has('code_rekxraw'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code_rekxraw') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rekxraw.fields.code_rekxraw_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="lijna_id">{{ trans('cruds.rekxraw.fields.lijna') }}</label>
                <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}" name="lijna_id" id="lijna_id" required>
                    @foreach($lijnas as $id => $entry)
                        <option value="{{ $id }}" {{ old('lijna_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lijna'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rekxraw.fields.lijna_helper') }}</span>
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