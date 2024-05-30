@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pasien.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.pasiens.update", [$pasien->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.pasien.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $pasien->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pasien.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="gender">{{ trans('cruds.pasien.fields.gender') }}</label>
                <input class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" type="text" name="gender" id="gender" value="{{ old('gender', $pasien->gender) }}">
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pasien.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="umur">{{ trans('cruds.pasien.fields.umur') }}</label>
                <input class="form-control {{ $errors->has('umur') ? 'is-invalid' : '' }}" type="number" name="umur" id="umur" value="{{ old('umur', $pasien->umur) }}" step="0.01">
                @if($errors->has('umur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('umur') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pasien.fields.umur_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat">{{ trans('cruds.pasien.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat" id="alamat" value="{{ old('alamat', $pasien->alamat) }}" step="1">
                @if($errors->has('alamat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pasien.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="penyakit">{{ trans('cruds.pasien.fields.penyakit') }}</label>
                <input class="form-control {{ $errors->has('penyakit') ? 'is-invalid' : '' }}" type="text" name="penyakit" id="penyakit" value="{{ old('penyakit', $pasien->penyakit) }}" step="1">
                @if($errors->has('penyakit'))
                    <div class="invalid-feedback">
                        {{ $errors->first('penyakit') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pasien.fields.penyakit_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.pasiens.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image"]').remove()
      $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($pasien) && $pasien->image)
      var file = {!! json_encode($pasien->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
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