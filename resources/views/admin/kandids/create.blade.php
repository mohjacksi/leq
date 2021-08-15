@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.kandid.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.kandids.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="nav">{{ trans('cruds.kandid.fields.nav') }}</label>
                <input class="form-control {{ $errors->has('nav') ? 'is-invalid' : '' }}" type="text" name="nav" id="nav" value="{{ old('nav', '') }}" required>
                @if($errors->has('nav'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nav') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.nav_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="jimara_kandidi">{{ trans('cruds.kandid.fields.jimara_kandidi') }}</label>
                <input class="form-control {{ $errors->has('jimara_kandidi') ? 'is-invalid' : '' }}" type="text" name="jimara_kandidi" id="jimara_kandidi" value="{{ old('jimara_kandidi', '') }}" required>
                @if($errors->has('jimara_kandidi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('jimara_kandidi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.jimara_kandidi_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="layene_siyasi_id">{{ trans('cruds.kandid.fields.layene_siyasi') }}</label>
                <select class="form-control select2 {{ $errors->has('layene_siyasi') ? 'is-invalid' : '' }}" name="layene_siyasi_id" id="layene_siyasi_id">
                    @foreach($layene_siyasis as $id => $entry)
                        <option value="{{ $id }}" {{ old('layene_siyasi_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('layene_siyasi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('layene_siyasi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.layene_siyasi_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="extra">{{ trans('cruds.kandid.fields.extra') }}</label>
                <input class="form-control {{ $errors->has('extra') ? 'is-invalid' : '' }}" type="text" name="extra" id="extra" value="{{ old('extra', '') }}">
                @if($errors->has('extra'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extra') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.extra_helper') }}</span>
            </div>
            
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="ala">{{ trans('cruds.kandid.fields.ala') }}</label>
                <div class="needsclick dropzone {{ $errors->has('ala') ? 'is-invalid' : '' }}" id="ala-dropzone">
                </div>
                @if($errors->has('ala'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ala') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.ala_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label for="wene">{{ trans('cruds.kandid.fields.wene') }}</label>
                <div class="needsclick dropzone {{ $errors->has('wene') ? 'is-invalid' : '' }}" id="wene-dropzone">
                </div>
                @if($errors->has('wene'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wene') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.kandid.fields.wene_helper') }}</span>
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
    url: '{{ route('admin.kandids.storeMedia') }}',
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
@if(isset($kandid) && $kandid->ala)
      var files = {!! json_encode($kandid->ala) !!}
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
<script>
    Dropzone.options.weneDropzone = {
    url: '{{ route('admin.kandids.storeMedia') }}',
    maxFilesize: 500, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="wene"]').remove()
      $('form').append('<input type="hidden" name="wene" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="wene"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($kandid) && $kandid->wene)
      var file = {!! json_encode($kandid->wene) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="wene" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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