@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $role)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="lijna_id">{{ trans('cruds.user.fields.lijna') }}</label>
                <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}" name="lijna_id" id="lijna_id">
                    @foreach($lijnas as $id => $entry)
                        <option value="{{ $id }}" {{ old('lijna_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lijna'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.lijna_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="bingeh_id">{{ trans('cruds.user.fields.bingeh') }}</label>
                <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}" name="bingeh_id" id="bingeh_id">
                    @foreach($bingehs as $id => $entry)
                        <option value="{{ $id }}" {{ old('bingeh_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bingeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.bingeh_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="user_type_id">{{ trans('cruds.user.fields.user_type') }}</label>
                <select class="form-control select2 {{ $errors->has('user_type') ? 'is-invalid' : '' }}" name="user_type_id" id="user_type_id" required>
                    @foreach($user_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.user_type_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <button class="btn btn-primary btn-lg btn-block" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection