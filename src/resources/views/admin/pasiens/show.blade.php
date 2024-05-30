@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.pasien.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pasiens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.id') }}
                        </th>
                        <td>
                            {{ $pasien->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.name') }}
                        </th>
                        <td>
                            {{ $pasien->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.gender') }}
                        </th>
                        <td>
                            {{ $pasien->gender }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.umur') }}
                        </th>
                        <td>
                            {{ $pasien->umur }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.alamat') }}
                        </th>
                        <td>
                            {{ $pasien->alamat }}
                        </td>
                    </tr>   
                    <tr>
                        <th>
                            {{ trans('cruds.pasien.fields.penyakit') }}
                        </th>
                        <td>
                            {{ $pasien->penyakit }}
                        </td>
                    </tr>   
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.pasiens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection