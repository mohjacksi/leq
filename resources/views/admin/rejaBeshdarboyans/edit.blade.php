@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.rejaBeshdarboyan.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.reja-beshdarboyans.update", [$rejaBeshdarboyan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="leq_id">{{ trans('cruds.rejaBeshdarboyan.fields.leq') }}</label>
                <select class="form-control select2 {{ $errors->has('leq') ? 'is-invalid' : '' }}" name="leq_id" id="leq_id">
                    @foreach($leqs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('leq_id') ? old('leq_id') : $rejaBeshdarboyan->leq->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('leq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rejaBeshdarboyan.fields.leq_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="lijna_id">{{ trans('cruds.rejaBeshdarboyan.fields.lijna') }}</label>
                <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}" name="lijna_id" id="lijna_id">
                    @foreach($lijnas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lijna_id') ? old('lijna_id') : $rejaBeshdarboyan->lijna->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lijna'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rejaBeshdarboyan.fields.lijna_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="bingeh_id">{{ trans('cruds.rejaBeshdarboyan.fields.bingeh') }}</label>
                <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}" name="bingeh_id" id="bingeh_id">
                    @foreach($bingehs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bingeh_id') ? old('bingeh_id') : $rejaBeshdarboyan->bingeh->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bingeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rejaBeshdarboyan.fields.bingeh_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="demjimer">{{ trans('cruds.rejaBeshdarboyan.fields.demjimer') }}</label>
                <input class="form-control timepicker {{ $errors->has('demjimer') ? 'is-invalid' : '' }}" type="text" name="demjimer" id="demjimer" value="{{ old('demjimer', $rejaBeshdarboyan->demjimer) }}" required>
                @if($errors->has('demjimer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('demjimer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rejaBeshdarboyan.fields.demjimer_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="jimara_beshdarboyan">{{ trans('cruds.rejaBeshdarboyan.fields.jimara_beshdarboyan') }}</label>
                <input class="form-control {{ $errors->has('jimara_beshdarboyan') ? 'is-invalid' : '' }}" type="number" name="jimara_beshdarboyan" id="jimara_beshdarboyan" value="{{ old('jimara_beshdarboyan', $rejaBeshdarboyan->jimara_beshdarboyan) }}" step="1" required>
                @if($errors->has('jimara_beshdarboyan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_beshdarboyan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.rejaBeshdarboyan.fields.jimara_beshdarboyan_helper') }}</span>
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