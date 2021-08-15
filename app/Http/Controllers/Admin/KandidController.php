<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyKandidRequest;
use App\Http\Requests\StoreKandidRequest;
use App\Http\Requests\UpdateKandidRequest;
use App\Models\Kandid;
use App\Models\Layenetsiyasi;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class KandidController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('kandid_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Kandid::with(['layene_siyasi'])->select(sprintf('%s.*', (new Kandid())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'kandid_show';
                $editGate = 'kandid_edit';
                $deleteGate = 'kandid_delete';
                $crudRoutePart = 'kandids';

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
            $table->editColumn('nav', function ($row) {
                return $row->nav ? $row->nav : '';
            });
            $table->editColumn('jimara_kandidi', function ($row) {
                return $row->jimara_kandidi ? $row->jimara_kandidi : '';
            });
            $table->addColumn('layene_siyasi_name', function ($row) {
                return $row->layene_siyasi ? $row->layene_siyasi->name : '';
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
            $table->editColumn('wene', function ($row) {
                if ($photo = $row->wene) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });
            $table->editColumn('extra', function ($row) {
                return $row->extra ? $row->extra : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'layene_siyasi', 'ala', 'wene']);

            return $table->make(true);
        }

        $layenetsiyasis = Layenetsiyasi::get();

        return view('admin.kandids.index', compact('layenetsiyasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('kandid_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.kandids.create', compact('layene_siyasis'));
    }

    public function store(StoreKandidRequest $request)
    {
        $kandid = Kandid::create($request->all());

        foreach ($request->input('ala', []) as $file) {
            $kandid->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ala');
        }

        if ($request->input('wene', false)) {
            $kandid->addMedia(storage_path('tmp/uploads/' . basename($request->input('wene'))))->toMediaCollection('wene');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $kandid->id]);
        }

        return redirect()->route('admin.kandids.index');
    }

    public function edit(Kandid $kandid)
    {
        abort_if(Gate::denies('kandid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $kandid->load('layene_siyasi');

        return view('admin.kandids.edit', compact('layene_siyasis', 'kandid'));
    }

    public function update(UpdateKandidRequest $request, Kandid $kandid)
    {
        $kandid->update($request->all());

        if (count($kandid->ala) > 0) {
            foreach ($kandid->ala as $media) {
                if (!in_array($media->file_name, $request->input('ala', []))) {
                    $media->delete();
                }
            }
        }
        $media = $kandid->ala->pluck('file_name')->toArray();
        foreach ($request->input('ala', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $kandid->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('ala');
            }
        }

        if ($request->input('wene', false)) {
            if (!$kandid->wene || $request->input('wene') !== $kandid->wene->file_name) {
                if ($kandid->wene) {
                    $kandid->wene->delete();
                }
                $kandid->addMedia(storage_path('tmp/uploads/' . basename($request->input('wene'))))->toMediaCollection('wene');
            }
        } elseif ($kandid->wene) {
            $kandid->wene->delete();
        }

        return redirect()->route('admin.kandids.index');
    }

    public function show(Kandid $kandid)
    {
        abort_if(Gate::denies('kandid_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kandid->load('layene_siyasi');

        return view('admin.kandids.show', compact('kandid'));
    }

    public function destroy(Kandid $kandid)
    {
        abort_if(Gate::denies('kandid_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $kandid->delete();

        return back();
    }

    public function massDestroy(MassDestroyKandidRequest $request)
    {
        Kandid::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('kandid_create') && Gate::denies('kandid_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Kandid();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
