@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.dengenLayenetsiyasi.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.dengen-layenetsiyasis.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="leq_id">{{ trans('cruds.dengenLayenetsiyasi.fields.leq') }}</label>
                <select class="form-control select2 {{ $errors->has('leq') ? 'is-invalid' : '' }}" name="leq_id" id="leq_id" required>
                    @foreach($leqs as $id => $entry)
                        <option value="{{ $id }}" {{ old('leq_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('leq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.leq_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="lijna_id">{{ trans('cruds.dengenLayenetsiyasi.fields.lijna') }}</label>
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
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.lijna_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="bingeh_id">{{ trans('cruds.dengenLayenetsiyasi.fields.bingeh') }}</label>
                <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}" name="bingeh_id" id="bingeh_id" required>
                    @foreach($bingehs as $id => $entry)
                        <option value="{{ $id }}" {{ old('bingeh_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bingeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.bingeh_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="westgeh_id">{{ trans('cruds.dengenLayenetsiyasi.fields.westgeh') }}</label>
                <select class="form-control select2 {{ $errors->has('westgeh') ? 'is-invalid' : '' }}" name="westgeh_id" id="westgeh_id" required>
                    @foreach($westgehs as $id => $entry)
                        <option value="{{ $id }}" {{ old('westgeh_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('westgeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('westgeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.westgeh_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="layene_siyasi_id">{{ trans('cruds.dengenLayenetsiyasi.fields.layene_siyasi') }}</label>
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
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.layene_siyasi_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="jimara_dengan">{{ trans('cruds.dengenLayenetsiyasi.fields.jimara_dengan') }}</label>
                <input class="form-control {{ $errors->has('jimara_dengan') ? 'is-invalid' : '' }}" type="number" name="jimara_dengan" id="jimara_dengan" value="{{ old('jimara_dengan', '0') }}" step="1" required>
                @if($errors->has('jimara_dengan'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_dengan') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.jimara_dengan_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="weene">{{ trans('cruds.dengenLayenetsiyasi.fields.weene') }}</label>
                <div class="needsclick dropzone {{ $errors->has('weene') ? 'is-invalid' : '' }}" id="weene-dropzone">
                </div>
                @if($errors->has('weene'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weene') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.weene_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="file">{{ trans('cruds.dengenLayenetsiyasi.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.file_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="extra_1">{{ trans('cruds.dengenLayenetsiyasi.fields.extra_1') }}</label>
                <input class="form-control {{ $errors->has('extra_1') ? 'is-invalid' : '' }}" type="text" name="extra_1" id="extra_1" value="{{ old('extra_1', '') }}">
                @if($errors->has('extra_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.extra_1_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="extra_2">{{ trans('cruds.dengenLayenetsiyasi.fields.extra_2') }}</label>
                <input class="form-control {{ $errors->has('extra_2') ? 'is-invalid' : '' }}" type="text" name="extra_2" id="extra_2" value="{{ old('extra_2', '') }}">
                @if($errors->has('extra_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.dengenLayenetsiyasi.fields.extra_2_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedWeeneMap = {}
Dropzone.options.weeneDropzone = {
    url: '{{ route('admin.dengen-layenetsiyasis.storeMedia') }}',
    maxFilesize: 250, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 250,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="weene[]" value="' + response.name + '">')
      uploadedWeeneMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedWeeneMap[file.name]
      }
      $('form').find('input[name="weene[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($dengenLayenetsiyasi) && $dengenLayenetsiyasi->weene)
      var files = {!! json_encode($dengenLayenetsiyasi->weene) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="weene[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
<script>
    var uploadedFileMap = {}
Dropzone.options.fileDropzone = {
    url: '{{ route('admin.dengen-layenetsiyasis.storeMedia') }}',
    maxFilesize: 500, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 500
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
      uploadedFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($dengenLayenetsiyasi) && $dengenLayenetsiyasi->file)
          var files =
            {!! json_encode($dengenLayenetsiyasi->file) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection