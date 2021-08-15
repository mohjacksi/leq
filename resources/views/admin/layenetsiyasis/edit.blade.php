@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.layenetsiyasi.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.layenetsiyasis.update", [$layenetsiyasi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="name">{{ trans('cruds.layenetsiyasi.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $layenetsiyasi->name) }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.layenetsiyasi.fields.name_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="code_siyasi">{{ trans('cruds.layenetsiyasi.fields.code_siyasi') }}</label>
                <input class="form-control {{ $errors->has('code_siyasi') ? 'is-invalid' : '' }}" type="text" name="code_siyasi" id="code_siyasi" value="{{ old('code_siyasi', $layenetsiyasi->code_siyasi) }}" required>
                @if($errors->has('code_siyasi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('code_siyasi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.layenetsiyasi.fields.code_siyasi_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            
            <div class="form-group col-md-6">
                <label class="required" for="jimara_kandida">{{ trans('cruds.layenetsiyasi.fields.jimara_kandida') }}</label>
                <input class="form-control {{ $errors->has('jimara_kandida') ? 'is-invalid' : '' }}" type="number" name="jimara_kandida" id="jimara_kandida" value="{{ old('jimara_kandida', $layenetsiyasi->jimara_kandida) }}" step="1" required>
                @if($errors->has('jimara_kandida'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_kandida') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.layenetsiyasi.fields.jimara_kandida_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="extra">{{ trans('cruds.layenetsiyasi.fields.extra') }}</label>
                <input class="form-control {{ $errors->has('extra') ? 'is-invalid' : '' }}" type="text" name="extra" id="extra" value="{{ old('extra', $layenetsiyasi->extra) }}">
                @if($errors->has('extra'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.layenetsiyasi.fields.extra_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12">
                <label class="required" for="ala">{{ trans('cruds.layenetsiyasi.fields.ala') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ala') ? 'is-invalid' : '' }}" id="ala-dropzone">
                </div>
                @if($errors->has('ala'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ala') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.layenetsiyasi.fields.ala_helper') }}</span>
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
    var uploadedAlaMap = {}
Dropzone.options.alaDropzone = {
    url: '{{ route('admin.layenetsiyasis.storeMedia') }}',
    maxFilesize: 500, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 500,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="ala[]" value="' + response.name + '">')
      uploadedAlaMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAlaMap[file.name]
      }
      $('form').find('input[name="ala[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($layenetsiyasi) && $layenetsiyasi->ala)
      var files = {!! json_encode($layenetsiyasi->ala) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="ala[]" value="' + file.file_name + '">')
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