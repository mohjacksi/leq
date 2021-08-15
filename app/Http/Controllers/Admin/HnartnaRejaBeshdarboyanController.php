<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHnartnaRejaBeshdarboyanRequest;
use App\Http\Requests\StoreHnartnaRejaBeshdarboyanRequest;
use App\Http\Requests\UpdateHnartnaRejaBeshdarboyanRequest;
use App\Models\Bingeh;
use App\Models\HnartnaRejaBeshdarboyan;
use App\Models\Leq;
use App\Models\Lijna;
use App\Models\Westgeh;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class HnartnaRejaBeshdarboyanController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = HnartnaRejaBeshdarboyan::with(['leq', 'lijna', 'bingeh', 'wistgeh'])->select(sprintf('%s.*', (new HnartnaRejaBeshdarboyan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'hnartna_reja_beshdarboyan_show';
                $editGate = 'hnartna_reja_beshdarboyan_edit';
                $deleteGate = 'hnartna_reja_beshdarboyan_delete';
                $crudRoutePart = 'hnartna-reja-beshdarboyans';

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

            $table->editColumn('hejmar', function ($row) {
                return $row->hejmar ? $row->hejmar : '';
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

        return view('admin.hnartnaRejaBeshdarboyans.index', compact('leqs', 'lijnas', 'bingehs', 'westgehs'));
    }

    public function create()
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wistgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.hnartnaRejaBeshdarboyans.create', compact('leqs', 'lijnas', 'bingehs', 'wistgehs'));
    }

    public function store(StoreHnartnaRejaBeshdarboyanRequest $request)
    {
        $hnartnaRejaBeshdarboyan = HnartnaRejaBeshdarboyan::create($request->all());

        foreach ($request->input('wene', []) as $file) {
            $hnartnaRejaBeshdarboyan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('wene');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $hnartnaRejaBeshdarboyan->id]);
        }

        return redirect()->route('admin.hnartna-reja-beshdarboyans.index');
    }

    public function edit(HnartnaRejaBeshdarboyan $hnartnaRejaBeshdarboyan)
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $wistgehs = Westgeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $hnartnaRejaBeshdarboyan->load('leq', 'lijna', 'bingeh', 'wistgeh');

        return view('admin.hnartnaRejaBeshdarboyans.edit', compact('leqs', 'lijnas', 'bingehs', 'wistgehs', 'hnartnaRejaBeshdarboyan'));
    }

    public function update(UpdateHnartnaRejaBeshdarboyanRequest $request, HnartnaRejaBeshdarboyan $hnartnaRejaBeshdarboyan)
    {
        $hnartnaRejaBeshdarboyan->update($request->all());

        if (count($hnartnaRejaBeshdarboyan->wene) > 0) {
            foreach ($hnartnaRejaBeshdarboyan->wene as $media) {
                if (!in_array($media->file_name, $request->input('wene', []))) {
                    $media->delete();
                }
            }
        }
        $media = $hnartnaRejaBeshdarboyan->wene->pluck('file_name')->toArray();
        foreach ($request->input('wene', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $hnartnaRejaBeshdarboyan->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('wene');
            }
        }

        return redirect()->route('admin.hnartna-reja-beshdarboyans.index');
    }

    public function show(HnartnaRejaBeshdarboyan $hnartnaRejaBeshdarboyan)
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hnartnaRejaBeshdarboyan->load('leq', 'lijna', 'bingeh', 'wistgeh');

        return view('admin.hnartnaRejaBeshdarboyans.show', compact('hnartnaRejaBeshdarboyan'));
    }

    public function destroy(HnartnaRejaBeshdarboyan $hnartnaRejaBeshdarboyan)
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hnartnaRejaBeshdarboyan->delete();

        return back();
    }

    public function massDestroy(MassDestroyHnartnaRejaBeshdarboyanRequest $request)
    {
        HnartnaRejaBeshdarboyan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('hnartna_reja_beshdarboyan_create') && Gate::denies('hnartna_reja_beshdarboyan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HnartnaRejaBeshdarboyan();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
