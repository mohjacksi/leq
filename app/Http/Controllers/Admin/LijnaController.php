<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLijnaRequest;
use App\Http\Requests\StoreLijnaRequest;
use App\Http\Requests\UpdateLijnaRequest;
use App\Models\Leq;
use App\Models\Lijna;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LijnaController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('lijna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Lijna::with(['leq'])->select(sprintf('%s.*', (new Lijna())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'lijna_show';
                $editGate = 'lijna_edit';
                $deleteGate = 'lijna_delete';
                $crudRoutePart = 'lijnas';

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
            $table->editColumn('lijna_code', function ($row) {
                return $row->lijna_code ? $row->lijna_code : '';
            });
            $table->addColumn('leq_name', function ($row) {
                return $row->leq ? $row->leq->name : '';
            });

            $table->editColumn('jimara_dengderan', function ($row) {
                return $row->jimara_dengderan ? $row->jimara_dengderan : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'leq']);

            return $table->make(true);
        }

        $leqs = Leq::get();

        return view('admin.lijnas.index', compact('leqs'));
    }

    public function create()
    {
        abort_if(Gate::denies('lijna_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.lijnas.create', compact('leqs'));
    }

    public function store(StoreLijnaRequest $request)
    {
        $lijna = Lijna::create($request->all());

        return redirect()->route('admin.lijnas.index');
    }

    public function edit(Lijna $lijna)
    {
        abort_if(Gate::denies('lijna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijna->load('leq');

        return view('admin.lijnas.edit', compact('leqs', 'lijna'));
    }

    public function update(UpdateLijnaRequest $request, Lijna $lijna)
    {
        $lijna->update($request->all());

        return redirect()->route('admin.lijnas.index');
    }

    public function show(Lijna $lijna)
    {
        abort_if(Gate::denies('lijna_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijna->load('leq', 'lijnaRekxraws', 'lijnaHnartnaDengans');

        return view('admin.lijnas.show', compact('lijna'));
    }

    public function destroy(Lijna $lijna)
    {
        abort_if(Gate::denies('lijna_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijna->delete();

        return back();
    }

    public function massDestroy(MassDestroyLijnaRequest $request)
    {
        Lijna::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
