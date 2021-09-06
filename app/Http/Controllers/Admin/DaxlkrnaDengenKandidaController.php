<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyDaxlkrnaDengenKandidaRequest;
use App\Http\Requests\StoreDaxlkrnaDengenKandidaRequest;
use App\Http\Requests\UpdateDaxlkrnaDengenKandidaRequest;
use App\Models\Bingeh;
use App\Models\DaxlkrnaDengenKandida;
use App\Models\Kandid;
use App\Models\Layenetsiyasi;
use App\Models\Leq;
use App\Models\Lijna;
use App\Models\Westgeh;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class DaxlkrnaDengenKandidaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = DaxlkrnaDengenKandida::with(['leq', 'lijna', 'bingeh', 'westgeh', 'layenesiyasi', 'jimara_kandidi'])->select(sprintf('%s.*', (new DaxlkrnaDengenKandida())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'daxlkrna_dengen_kandida_show';
                $editGate = 'daxlkrna_dengen_kandida_edit';
                $deleteGate = 'daxlkrna_dengen_kandida_delete';
                $crudRoutePart = 'daxlkrna-dengen-kandidas';

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

            $table->addColumn('layenesiyasi_name', function ($row) {
                return $row->layenesiyasi ? $row->layenesiyasi->name : '';
            });

            $table->addColumn('jimara_kandidi_jimara_kandidi', function ($row) {
                return $row->jimara_kandidi ? $row->jimara_kandidi->jimara_kandidi : '';
            });

            $table->editColumn('jimara_kandidi.nav', function ($row) {
                return $row->jimara_kandidi ? (is_string($row->jimara_kandidi) ? $row->jimara_kandidi : $row->jimara_kandidi->nav) : '';
            });
            $table->editColumn('jimara_kandidi.extra', function ($row) {
                return $row->jimara_kandidi ? (is_string($row->jimara_kandidi) ? $row->jimara_kandidi : $row->jimara_kandidi->extra) : '';
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

            $table->rawColumns(['actions', 'placeholder', 'leq', 'lijna', 'bingeh', 'westgeh', 'layenesiyasi', 'jimara_kandidi', 'weene', 'file']);

            return $table->make(true);
        }

        $leqs           = Leq::get();
        $lijnas         = Lijna::get();
        $bingehs        = Bingeh::get();
        $westgehs       = Westgeh::get();
        $layenetsiyasis = Layenetsiyasi::get();
        $kandids        = Kandid::get();

        return view('admin.daxlkrnaDengenKandidas.index', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layenetsiyasis', 'kandids'));
    }
    function contains($needle, $haystack)
    {
        return strpos($haystack, $needle) !== false;
    }
    public function create()
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $westgehs = Westgeh::pluck('name', 'id')->prepend('هەمی وێستگەهێن بنگەهی');

        $layenesiyasis = Layenetsiyasi::get()->prepend(trans('global.pleaseSelect'), '');

        $jimara_kandidis = Kandid::get()->prepend(trans('global.pleaseSelect'), '');

        $user = Auth::user();

        $user_type = $user->user_type->code;
        $user_lijna = $user->lijna;
        $user_bingeh = $user->bingeh;


        if ($this->contains($user_type, 'admin')) {
            $lijnas = Lijna::get()->prepend(trans('global.pleaseSelect'), '');
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
            $leqs = Leq::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'leq')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            //
            $lijnas = Lijna::get()->prepend(trans('global.pleaseSelect'), '');
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'lijna')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            $lijnas = Lijna::where('id', $user->lijna_id)->get();
            //
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'bingeh')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            $lijnas = Lijna::where('id', $user->lijna_id)->get();
            $bingehs = Bingeh::where('id', $user->bingeh_id)->get();
        }




        return view('admin.daxlkrnaDengenKandidas.create', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layenesiyasis', 'jimara_kandidis'));
    }

    public function store(StoreDaxlkrnaDengenKandidaRequest $request)
    {
        $daxlkrnaDengenKandida = DaxlkrnaDengenKandida::create($request->all());

        foreach ($request->input('weene', []) as $file) {
            $daxlkrnaDengenKandida->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('weene');
        }

        foreach ($request->input('file', []) as $file) {
            $daxlkrnaDengenKandida->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $daxlkrnaDengenKandida->id]);
        }

        return redirect()->route('admin.daxlkrna-dengen-kandidas.index');
    }

    public function edit(DaxlkrnaDengenKandida $daxlkrnaDengenKandida)
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $westgehs = Westgeh::pluck('name', 'id')->prepend('هەمی وێستگەهێن بنگەهی');

        $layenesiyasis = Layenetsiyasi::get()->prepend(trans('global.pleaseSelect'), '');

        $jimara_kandidis = Kandid::get()->prepend(trans('global.pleaseSelect'), '');

        $user = Auth::user();

        $user_type = $user->user_type->code;
        $user_lijna = $user->lijna;
        $user_bingeh = $user->bingeh;


        if ($this->contains($user_type, 'admin')) {
            $lijnas = Lijna::get()->prepend(trans('global.pleaseSelect'), '');
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
            $leqs = Leq::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'leq')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            //
            $lijnas = Lijna::get()->prepend(trans('global.pleaseSelect'), '');
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'lijna')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            $lijnas = Lijna::where('id', $user->lijna_id)->get();
            //
            $bingehs = Bingeh::get()->prepend(trans('global.pleaseSelect'), '');
        } elseif ($this->contains($user_type, 'bingeh')) {
            $leqs = Leq::where('id', $user->leq_id)->get();
            $lijnas = Lijna::where('id', $user->lijna_id)->get();
            $bingehs = Bingeh::where('id', $user->bingeh_id)->get();
        }


        return view('admin.daxlkrnaDengenKandidas.edit', compact('leqs', 'lijnas', 'bingehs', 'westgehs', 'layenesiyasis', 'jimara_kandidis', 'daxlkrnaDengenKandida'));
    }

    public function update(UpdateDaxlkrnaDengenKandidaRequest $request, DaxlkrnaDengenKandida $daxlkrnaDengenKandida)
    {
        $daxlkrnaDengenKandida->update($request->all());

        if (count($daxlkrnaDengenKandida->weene) > 0) {
            foreach ($daxlkrnaDengenKandida->weene as $media) {
                if (!in_array($media->file_name, $request->input('weene', []))) {
                    $media->delete();
                }
            }
        }
        $media = $daxlkrnaDengenKandida->weene->pluck('file_name')->toArray();
        foreach ($request->input('weene', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $daxlkrnaDengenKandida->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('weene');
            }
        }

        if (count($daxlkrnaDengenKandida->file) > 0) {
            foreach ($daxlkrnaDengenKandida->file as $media) {
                if (!in_array($media->file_name, $request->input('file', []))) {
                    $media->delete();
                }
            }
        }
        $media = $daxlkrnaDengenKandida->file->pluck('file_name')->toArray();
        foreach ($request->input('file', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $daxlkrnaDengenKandida->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('file');
            }
        }

        return redirect()->route('admin.daxlkrna-dengen-kandidas.index');
    }

    public function show(DaxlkrnaDengenKandida $daxlkrnaDengenKandida)
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daxlkrnaDengenKandida->load('leq', 'lijna', 'bingeh', 'westgeh', 'layenesiyasi', 'jimara_kandidi');

        return view('admin.daxlkrnaDengenKandidas.show', compact('daxlkrnaDengenKandida'));
    }

    public function destroy(DaxlkrnaDengenKandida $daxlkrnaDengenKandida)
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $daxlkrnaDengenKandida->delete();

        return back();
    }

    public function massDestroy(MassDestroyDaxlkrnaDengenKandidaRequest $request)
    {
        DaxlkrnaDengenKandida::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('daxlkrna_dengen_kandida_create') && Gate::denies('daxlkrna_dengen_kandida_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new DaxlkrnaDengenKandida();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
