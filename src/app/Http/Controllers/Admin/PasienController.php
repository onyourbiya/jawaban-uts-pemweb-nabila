<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPasienRequest;
use App\Http\Requests\StorePasienRequest;
use App\Http\Requests\UpdatePasienRequest;
use App\Models\Pasien;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PasienController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('pasien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pasiens = Pasien::with(['media'])->get();

        return view('admin.pasiens.index', compact('pasiens'));
    }

    public function create()
    {
        abort_if(Gate::denies('pasien_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pasiens.create');
    }

    public function store(StorePasienRequest $request)
    {
        $pasien = Pasien::create($request->all());

        if ($request->input('image', false)) {
            $pasien->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $pasien->id]);
        }

        return redirect()->route('admin.pasiens.index');
    }

    public function edit(Pasien $pasien)
    {
        abort_if(Gate::denies('pasien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pasiens.edit', compact('pasien'));
    }

    public function update(UpdatePasienRequest $request, Pasien $pasien)
    {
        $pasien->update($request->all());

        if ($request->input('image', false)) {
            if (! $pasien->image || $request->input('image') !== $pasien->image->file_name) {
                if ($pasien->image) {
                    $pasien->image->delete();
                }
                $pasien->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($pasien->image) {
            $pasien->image->delete();
        }

        return redirect()->route('admin.pasiens.index');
    }

    public function show(Pasien $pasien)
    {
        abort_if(Gate::denies('pasien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.pasiens.show', compact('pasien'));
    }

    public function destroy(Pasien $pasien)
    {
        abort_if(Gate::denies('pasien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $pasien->delete();

        return back();
    }

    public function massDestroy(MassDestroyPasienRequest $request)
    {
        $pasiens = Pasien::find(request('ids'));

        foreach ($pasiens as $pasien) {
            $pasien->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('pasien_create') && Gate::denies('pasien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Pasien();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
