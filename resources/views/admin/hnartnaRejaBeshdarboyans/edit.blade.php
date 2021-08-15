@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.hnartnaRejaBeshdarboyan.title_singular') }}
    </div>

    <div class="card-body text-info">
        <form method="POST" action="{{ route("admin.hnartna-reja-beshdarboyans.update", [$hnartnaRejaBeshdarboyan->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-row">

            <div class="form-group col-md-6">
                <label class="required" for="leq_id">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.leq') }}</label>
                <select class="form-control select2 {{ $errors->has('leq') ? 'is-invalid' : '' }}" name="leq_id" id="leq_id" required>
                    @foreach($leqs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('leq_id') ? old('leq_id') : $hnartnaRejaBeshdarboyan->leq->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('leq'))
                    <div class="invalid-feedback">
                        {{ $errors->first('leq') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.leq_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="lijna_id">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.lijna') }}</label>
                <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}" name="lijna_id" id="lijna_id" required>
                    @foreach($lijnas as $id => $entry)
                        <option value="{{ $id }}" {{ (old('lijna_id') ? old('lijna_id') : $hnartnaRejaBeshdarboyan->lijna->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('lijna'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lijna') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.lijna_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="bingeh_id">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.bingeh') }}</label>
                <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}" name="bingeh_id" id="bingeh_id" required>
                    @foreach($bingehs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bingeh_id') ? old('bingeh_id') : $hnartnaRejaBeshdarboyan->bingeh->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bingeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bingeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.bingeh_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="wistgeh_id">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wistgeh') }}</label>
                <select class="form-control select2 {{ $errors->has('wistgeh') ? 'is-invalid' : '' }}" name="wistgeh_id" id="wistgeh_id" required>
                    @foreach($wistgehs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('wistgeh_id') ? old('wistgeh_id') : $hnartnaRejaBeshdarboyan->wistgeh->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('wistgeh'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wistgeh') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wistgeh_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label class="required" for="hejmar">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.hejmar') }}</label>
                <input class="form-control {{ $errors->has('hejmar') ? 'is-invalid' : '' }}" type="number" name="hejmar" id="hejmar" value="{{ old('hejmar', $hnartnaRejaBeshdarboyan->hejmar) }}" step="1" required>
                @if($errors->has('hejmar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hejmar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.hejmar_helper') }}</span>
            </div>
            <div class="form-group col-md-6">
                <label class="required" for="dem">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.dem') }}</label>
                <input class="form-control datetime {{ $errors->has('dem') ? 'is-invalid' : '' }}" type="text" name="dem" id="dem" value="{{ old('dem', $hnartnaRejaBeshdarboyan->dem) }}" required>
                @if($errors->has('dem'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dem') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.dem_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="wene">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wene') }}</label>
                <div class="needsclick dropzone {{ $errors->has('wene') ? 'is-invalid' : '' }}" id="wene-dropzone">
                </div>
                @if($errors->has('wene'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wene') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.wene_helper') }}</span>
            </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-12">
                <label for="tebini">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.tebini') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('tebini') ? 'is-invalid' : '' }}" name="tebini" id="tebini">{!! old('tebini', $hnartnaRejaBeshdarboyan->tebini) !!}</textarea>
                @if($errors->has('tebini'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tebini') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.hnartnaRejaBeshdarboyan.fields.tebini_helper') }}</span>
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
    var uploadedWeneMap = {}
Dropzone.options.weneDropzone = {
    url: '{{ route('admin.hnartna-reja-beshdarboyans.storeMedia') }}',
    maxFilesize: 100, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 100,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="wene[]" value="' + response.name + '">')
      uploadedWeneMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedWeneMap[file.name]
      }
      $('form').find('input[name="wene[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($hnartnaRejaBeshdarboyan) && $hnartnaRejaBeshdarboyan->wene)
      var files = {!! json_encode($hnartnaRejaBeshdarboyan->wene) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="wene[]" value="' + file.file_name + '">')
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.hnartna-reja-beshdarboyans.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $hnartnaRejaBeshdarboyan->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection