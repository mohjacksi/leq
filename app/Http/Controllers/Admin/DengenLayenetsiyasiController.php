<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDengenLayenetsiyasiRequest;
use App\Http\Requests\StoreDengenLayenetsiyasiRequest;
use App\Http\Requests\UpdateDengenLayenetsiyasiRequest;
use App\Models\Bingeh;
use App\Models\DengenLayenetsiyasi;
use App\Models\Layenetsiyasi;
use App\Models\Leq;
use App\Models\Lijna;
use App\Models\Westgeh;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DengenLayenetsiyasiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DengenLayenetsiyasi::with(['leq', 'lijna', 'bingeh', 'westgeh', 'layene_siyasi'])->select(sprintf('%s.*', (new DengenLayenetsiyasi())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'dengen_layenetsiyasi_show';
                $editGate = 'dengen_layenetsiyasi_edit';
                $deleteGate = 'dengen_layenetsiyasi_delete';
                $crudRoutePart = 'dengen-layenetsiyasis';

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
            $table->addColumn('leq_name', function ($row) {
                return $row->leq ? $row->leq->name : '';
            });

            $table->addColumn('lijna_name', function ($row) {
                return $row->lijna ? $row->lijna->name : '';
            });

            $table->addColumn('bingeh_name', function ($row) {
                return $row->bingeh ? $row->bingeh->name : '';
            });

            $table->addColumn('westgeh_name', function ($row) {
                return $row->westgeh ? $row->westgeh->name : '';
            });

            $table->addColumn('layene_siyasi_name', function ($row) {
                return $row->layene_siyasi ? $row->layene_siyasi->name : '';
            });

            $table->editColumn('jimara_dengan', function ($row) {
                return $row->jimara_dengan ? $row->jimara_dengan : '';
            });
            $table->editColumn('weene', function ($row) {
                if (!$row->weene) {
                    return '';
                }
                $links = [];
                foreach ($row->weene as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });
            $table->editColumn('file', function ($row) {
                if (!$row->file) {
                    return '';
                }
                $links = [];
                foreach ($row->file as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });
            $table->editColumn('extra_1', function ($row) {
                return $row->extra_1 ? $row->extra_1 : '';
            });
            $table->editColumn('extra_2', function ($row) {
                return $row->extra_2 ? $row->extra_2 : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'leq', 'lijna', 'bingeh', 'westgeh', 'layene_siyasi', 'weene', 'file']);

            return $table->make(true);
        }

        $leqs           = Leq::get();
        $lijnas         = Lijna::get();
        $bingehs        = Bingeh::get();
        $westgehs       = Westgeh::get();
        $layenetsiyasis = Layenetsiyasi::get();

        return view('admin.dengenLayenetsiyasis.index', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layenetsiyasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $westgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.dengenLayenetsiyasis.create', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layene_siyasis'));
    }

    public function store(StoreDengenLayenetsiyasiRequest $request)
    {
        $dengenLayenetsiyasi = DengenLayenetsiyasi::create($request->all());

        foreach ($request->input('weene', []) as $file) {
            $dengenLayenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('weene');
        }

        foreach ($request->input('file', []) as $file) {
            $dengenLayenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $dengenLayenetsiyasi->id]);
        }

        return redirect()->route('admin.dengen-layenetsiyasis.index');
    }

    public function edit(DengenLayenetsiyasi $dengenLayenetsiyasi)
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $westgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $dengenLayenetsiyasi->load('leq', 'lijna', 'bingeh', 'westgeh', 'layene_siyasi');

        return view('admin.dengenLayenetsiyasis.edit', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layene_siyasis', 'dengenLayenetsiyasi'));
    }

    public function update(UpdateDengenLayenetsiyasiRequest $request, DengenLayenetsiyasi $dengenLayenetsiyasi)
    {
        $dengenLayenetsiyasi->update($request->all());

        if (count($dengenLayenetsiyasi->weene) > 0) {
            foreach ($dengenLayenetsiyasi->weene as $media) {
                if (!in_array($media->file_name, $request->input('weene', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dengenLayenetsiyasi->weene->pluck('file_name')->toArray();
        foreach ($request->input('weene', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dengenLayenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('weene');
            }
        }

        if (count($dengenLayenetsiyasi->file) > 0) {
            foreach ($dengenLayenetsiyasi->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $dengenLayenetsiyasi->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $dengenLayenetsiyasi->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.dengen-layenetsiyasis.index');
    }

    public function show(DengenLayenetsiyasi $dengenLayenetsiyasi)
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dengenLayenetsiyasi->load('leq', 'lijna', 'bingeh', 'westgeh', 'layene_siyasi');

        return view('admin.dengenLayenetsiyasis.show', compact('dengenLayenetsiyasi'));
    }

    public function destroy(DengenLayenetsiyasi $dengenLayenetsiyasi)
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $dengenLayenetsiyasi->delete();

        return back();
    }

    public function massDestroy(MassDestroyDengenLayenetsiyasiRequest $request)
    {
        DengenLayenetsiyasi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('dengen_layenetsiyasi_create') && Gate::denies('dengen_layenetsiyasi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DengenLayenetsiyasi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
