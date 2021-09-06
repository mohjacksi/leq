<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyLayenetsiyasiRequest;
use App\Http\Requests\StoreLayenetsiyasiRequest;
use App\Http\Requests\UpdateLayenetsiyasiRequest;
use App\Models\Layenetsiyasi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LayenetsiyasiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('layenetsiyasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Layenetsiyasi::query()->select(sprintf('%s.*', (new Layenetsiyasi())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'layenetsiyasi_show';
                $editGate = 'layenetsiyasi_edit';
                $deleteGate = 'layenetsiyasi_delete';
                $crudRoutePart = 'layenetsiyasis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('code_siyasi', function ($row) {
                return $row->code_siyasi ? $row->code_siyasi : '';
            });
            $table->editColumn('ala', function ($row) {
                if (!$row->ala) {
                    return '';
                }
                $links = [];
                foreach ($row->ala as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('jimara_kandida', function ($row) {
                return $row->jimara_kandida ? $row->jimara_kandida : '';
            });
            $table->editColumn('extra', function ($row) {
                return $row->extra ? $row->extra : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'ala']);

            return $table->make(true);
        }

        return view('admin.layenetsiyasis.index');
    }

    public function create()
    {
        abort_if(Gate::denies('layenetsiyasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.layenetsiyasis.create');
    }

    public function store(StoreLayenetsiyasiRequest $request)
    {
        $layenetsiyasi = Layenetsiyasi::create($request->all());

        foreach ($request->input('ala', []) as $file) {
            $layenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ala');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $layenetsiyasi->id]);
        }

        return redirect()->route('admin.layenetsiyasis.index');
    }

    public function edit(Layenetsiyasi $layenetsiyasi)
    {
        abort_if(Gate::denies('layenetsiyasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.layenetsiyasis.edit', compact('layenetsiyasi'));
    }

    public function update(UpdateLayenetsiyasiRequest $request, Layenetsiyasi $layenetsiyasi)
    {
        $layenetsiyasi->update($request->all());

        if (count($layenetsiyasi->ala) > 0) {
            foreach ($layenetsiyasi->ala as $media) {
                if (!in_array($media->file_name, $request->input('ala', []))) {
                    $media->delete();
                }
            }
        }
        $media = $layenetsiyasi->ala->pluck('file_name')->toArray();
        foreach ($request->input('ala', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $layenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ala');
            }
        }

        return redirect()->route('admin.layenetsiyasis.index');
    }

    public function show(Layenetsiyasi $layenetsiyasi)
    {
        abort_if(Gate::denies('layenetsiyasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layenetsiyasi->load('layeneSiyasiKandids', 'layeneSiyasiDengenLayenetsiyasis', 'layeneSiyasiLeqs');

        return view('admin.layenetsiyasis.show', compact('layenetsiyasi'));
    }

    public function destroy(Layenetsiyasi $layenetsiyasi)
    {
        abort_if(Gate::denies('layenetsiyasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layenetsiyasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyLayenetsiyasiRequest $request)
    {
        Layenetsiyasi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('layenetsiyasi_create') && Gate::denies('layenetsiyasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Layenetsiyasi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
