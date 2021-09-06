@extends('layouts.admin')
@section('content')

    <div class="card border-primary">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.daxlkrnaDengenKandida.title_singular') }}
        </div>

        <div class="card-body text-info">
            <form method="POST"
                action="{{ route('admin.daxlkrna-dengen-kandidas.update', [$daxlkrnaDengenKandida->id]) }}"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="leq_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.leq') }}</label>
                        <select class="form-control select2 {{ $errors->has('leq') ? 'is-invalid' : '' }}" name="leq_id"
                            id="leq_id" required>
                            @foreach ($leqs as $id => $entry)
                                <option value="{{ $entry->id ?? '' }}"
                                    {{ (old('leq_id') ? old('leq_id') : $daxlkrnaDengenKandida->leq->id ?? '') == ($entry->id ?? '') ? 'selected' : '' }}>
                                    {{ $entry->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('leq'))
                            <div class="invalid-feedback">
                                {{ $errors->first('leq') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.leq_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="lijna_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.lijna') }}</label>
                        <select class="form-control select2 {{ $errors->has('lijna') ? 'is-invalid' : '' }}"
                            name="lijna_id" id="lijna_id" required>
                            @foreach ($lijnas as $id => $entry)
                                <option class={{ $entry->leq_id ?? '' }} value="{{ $entry->id ?? '' }}"
                                    {{ (old('lijna_id') ? old('lijna_id') : $daxlkrnaDengenKandida->lijna->id ?? '') == ($entry->id ?? '') ? 'selected' : '' }}>
                                    {{ $entry->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('lijna'))
                            <div class="invalid-feedback">
                                {{ $errors->first('lijna') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.lijna_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="bingeh_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.bingeh') }}</label>
                        <select class="form-control select2 {{ $errors->has('bingeh') ? 'is-invalid' : '' }}"
                            name="bingeh_id" id="bingeh_id">
                            @foreach ($bingehs as $id => $entry)
                                <option class={{ $entry->lijna_id ?? '' }} value="{{ $entry->id ?? '' }}"
                                    {{ (old('bingeh_id') ? old('bingeh_id') : $daxlkrnaDengenKandida->bingeh->id ?? '') == ($entry->id ?? '') ? 'selected' : '' }}>
                                    {{ $entry->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('bingeh'))
                            <div class="invalid-feedback">
                                {{ $errors->first('bingeh') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.bingeh_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="westgeh_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.westgeh') }}</label>
                        <select class="form-control {{ $errors->has('westgeh') ? 'is-invalid' : '' }}" name="westgeh_id"
                            id="westgeh_id">
                            @foreach ($westgehs as $id => $entry)
                                {{ $entry }}
                                @if ($id == 0)
                                    <option value="">
                                        {{ $entry ?? '' }}</option>
                                @else
                                    <option value="{{ $id }}"
                                        {{ (old('westgeh_id') ? old('westgeh_id') : $daxlkrnaDengenKandida->westgeh->id ?? '') == $id ? 'selected' : '' }}>
                                        {{ $entry ?? '' }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('westgeh'))
                            <div class="invalid-feedback">
                                {{ $errors->first('westgeh') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.westgeh_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label class="required"
                            for="jimara_kandidi_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_kandidi') }}</label>
                        <select class="form-control select2 {{ $errors->has('jimara_kandidi') ? 'is-invalid' : '' }}"
                            name="jimara_kandidi_id" id="jimara_kandidi_id" required>
                            @foreach ($jimara_kandidis as $id => $entry)
                                <option class="{{ $entry->layene_siyasi_id ?? '' }}" value="{{ $entry->id ?? '' }}"
                                    {{ (old('jimara_kandidi_id') ? old('jimara_kandidi_id') : $daxlkrnaDengenKandida->jimara_kandidi->id ?? '') == ($entry->id ?? '') ? 'selected' : '' }}>
                                    {{ $entry->nav ?? '' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('jimara_kandidi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('jimara_kandidi') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_kandidi_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="layenesiyasi_id">{{ trans('cruds.daxlkrnaDengenKandida.fields.layenesiyasi') }}</label>
                        <select class="form-control {{ $errors->has('layenesiyasi') ? 'is-invalid' : '' }}"
                            name="layenesiyasi_id" id="layenesiyasi_id" required>
                            @foreach ($layenesiyasis as $id => $entry)
                                <option value="{{ $entry->id ?? '' }}"
                                    {{ (old('layenesiyasi_id') ? old('layenesiyasi_id') : $daxlkrnaDengenKandida->layenesiyasi->id ?? '') == ($entry->id ?? '') ? 'selected' : '' }}>
                                    {{ $entry->name ?? '' }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('layenesiyasi'))
                            <div class="invalid-feedback">
                                {{ $errors->first('layenesiyasi') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.layenesiyasi_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="required"
                            for="jimara_dengan">{{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_dengan') }}</label>
                        <input class="form-control {{ $errors->has('jimara_dengan') ? 'is-invalid' : '' }}" type="number"
                            name="jimara_dengan" id="jimara_dengan"
                            value="{{ old('jimara_dengan', $daxlkrnaDengenKandida->jimara_dengan) }}" step="1" required>
                        @if ($errors->has('jimara_dengan'))
                            <div class="invalid-feedback">
                                {{ $errors->first('jimara_dengan') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.jimara_dengan_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="weene">{{ trans('cruds.daxlkrnaDengenKandida.fields.weene') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('weene') ? 'is-invalid' : '' }}"
                            id="weene-dropzone">
                        </div>
                        @if ($errors->has('weene'))
                            <div class="invalid-feedback">
                                {{ $errors->first('weene') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.weene_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="file">{{ trans('cruds.daxlkrnaDengenKandida.fields.file') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}"
                            id="file-dropzone">
                        </div>
                        @if ($errors->has('file'))
                            <div class="invalid-feedback">
                                {{ $errors->first('file') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.file_helper') }}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="extra_1">{{ trans('cruds.daxlkrnaDengenKandida.fields.extra_1') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('extra_1') ? 'is-invalid' : '' }}"
                            name="extra_1" id="extra_1">{!! old('extra_1', $daxlkrnaDengenKandida->extra_1) !!}</textarea>
                        @if ($errors->has('extra_1'))
                            <div class="invalid-feedback">
                                {{ $errors->first('extra_1') }}
                            </div>
                        @endif

                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.extra_1_helper') }}</span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="extra_2">{{ trans('cruds.daxlkrnaDengenKandida.fields.extra_2') }}</label>
                        <input class="form-control {{ $errors->has('extra_2') ? 'is-invalid' : '' }}" type="text"
                            name="extra_2" id="extra_2" value="{{ old('extra_2', $daxlkrnaDengenKandida->extra_2) }}">
                        @if ($errors->has('extra_2'))
                            <div class="invalid-feedback">
                                {{ $errors->first('extra_2') }}
                            </div>
                        @endif
                        <span
                            class="help-block">{{ trans('cruds.daxlkrnaDengenKandida.fields.extra_2_helper') }}</span>
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
    @push('scripts')
        <script type="application/javascript">
            $(function() {
                $("#lijna_id").chained("#leq_id");
                $("#bingeh_id").chained("#lijna_id");
                $("#user_type_id").chained("#roles");
            })
        </script>
        <script type="application/javascript">
            $(function() { //run on document.ready
                $("#jimara_kandidi_id").change(function() { //this occurs when select 1 changes
                    var classList = $('option:selected', this).attr("class");
                    var classArr = classList.split(/\s+/);
                    console.log(classArr);
                    $("#layenesiyasi_id").val(classArr[0]);
                });
            });
        </script>

    @endpush
@endsection

@section('scripts')
    <script>
        var uploadedWeeneMap = {}
        Dropzone.options.weeneDropzone = {
            url: '{{ route('admin.daxlkrna-dengen-kandidas.storeMedia') }}',
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
            success: function(file, response) {
                $('form').append('<input type="hidden" name="weene[]" value="' + response.name + '">')
                uploadedWeeneMap[file.name] = response.name
            },
            removedfile: function(file) {
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
            init: function() {
                @if (isset($daxlkrnaDengenKandida) && $daxlkrnaDengenKandida->weene)
                    var files = {!! json_encode($daxlkrnaDengenKandida->weene) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="weene[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
            url: '{{ route('admin.daxlkrna-dengen-kandidas.storeMedia') }}',
            maxFilesize: 500, // MB
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 500
            },
            success: function(file, response) {
                $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
                uploadedFileMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedFileMap[file.name]
                }
                $('form').find('input[name="file[]"][value="' + name + '"]').remove()
            },
            init: function() {
                @if (isset($daxlkrnaDengenKandida) && $daxlkrnaDengenKandida->file)
                    var files =
                    {!! json_encode($daxlkrnaDengenKandida->file) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
                    }
                @endif
            },
            error: function(file, response) {
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
