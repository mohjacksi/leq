<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHnartnaDenganRequest;
use App\Http\Requests\StoreHnartnaDenganRequest;
use App\Http\Requests\UpdateHnartnaDenganRequest;
use App\Models\Bingeh;
use App\Models\HnartnaDengan;
use App\Models\Leq;
use App\Models\Lijna;
use App\Models\Westgeh;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HnartnaDenganController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hnartna_dengan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HnartnaDengan::with(['leq', 'lijna', 'bingeh', 'wistgeh'])->select(sprintf('%s.*', (new HnartnaDengan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hnartna_dengan_show';
                $editGate = 'hnartna_dengan_edit';
                $deleteGate = 'hnartna_dengan_delete';
                $crudRoutePart = 'hnartna-dengans';

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

            $table->addColumn('wistgeh_name', function ($row) {
                return $row->wistgeh ? $row->wistgeh->name : '';
            });

            $table->editColumn('wene', function ($row) {
                if (!$row->wene) {
                    return '';
                }
                $links = [];
                foreach ($row->wene as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank"><img src="' . $media->getUrl('thumb') . '" width="50px" height="50px"></a>';
                }

                return implode(' ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'leq', 'lijna', 'bingeh', 'wistgeh', 'wene']);

            return $table->make(true);
        }

        $leqs     = Leq::get();
        $lijnas   = Lijna::get();
        $bingehs  = Bingeh::get();
        $westgehs = Westgeh::get();

        return view('admin.hnartnaDengans.index', compact('leqs', 'lijnas', 'bingehs', 'westgehs'));
    }

    public function create()
    {
        abort_if(Gate::denies('hnartna_dengan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wistgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hnartnaDengans.create', compact('leqs', 'lijnas', 'bingehs', 'wistgehs'));
    }

    public function store(StoreHnartnaDenganRequest $request)
    {
        $hnartnaDengan = HnartnaDengan::create($request->all());

        foreach ($request->input('wene', []) as $file) {
            $hnartnaDengan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('wene');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hnartnaDengan->id]);
        }

        return redirect()->route('admin.hnartna-dengans.index');
    }

    public function edit(HnartnaDengan $hnartnaDengan)
    {
        abort_if(Gate::denies('hnartna_dengan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wistgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hnartnaDengan->load('leq', 'lijna', 'bingeh', 'wistgeh');

        return view('admin.hnartnaDengans.edit', compact('leqs', 'lijnas', 'bingehs', 'wistgehs', 'hnartnaDengan'));
    }

    public function update(UpdateHnartnaDenganRequest $request, HnartnaDengan $hnartnaDengan)
    {
        $hnartnaDengan->update($request->all());

        if (count($hnartnaDengan->wene) > 0) {
            foreach ($hnartnaDengan->wene as $media) {
                if (!in_array($media->file_name, $request->input('wene', []))) {
                    $media->delete();
                }
            }
        }
        $media = $hnartnaDengan->wene->pluck('file_name')->toArray();
        foreach ($request->input('wene', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $hnartnaDengan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('wene');
            }
        }

        return redirect()->route('admin.hnartna-dengans.index');
    }

    public function show(HnartnaDengan $hnartnaDengan)
    {
        abort_if(Gate::denies('hnartna_dengan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hnartnaDengan->load('leq', 'lijna', 'bingeh', 'wistgeh');

        return view('admin.hnartnaDengans.show', compact('hnartnaDengan'));
    }

    public function destroy(HnartnaDengan $hnartnaDengan)
    {
        abort_if(Gate::denies('hnartna_dengan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hnartnaDengan->delete();

        return back();
    }

    public function massDestroy(MassDestroyHnartnaDenganRequest $request)
    {
        HnartnaDengan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hnartna_dengan_create') && Gate::denies('hnartna_dengan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HnartnaDengan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
