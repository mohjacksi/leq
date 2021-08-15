<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLeqRequest;
use App\Http\Requests\StoreLeqRequest;
use App\Http\Requests\UpdateLeqRequest;
use App\Models\Layenetsiyasi;
use App\Models\Leq;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LeqController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('leq_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Leq::with(['layene_siyasi'])->select(sprintf('%s.*', (new Leq())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'leq_show';
                $editGate = 'leq_edit';
                $deleteGate = 'leq_delete';
                $crudRoutePart = 'leqs';

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
            $table->addColumn('layene_siyasi_name', function ($row) {
                return $row->layene_siyasi ? $row->layene_siyasi->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('leq_code', function ($row) {
                return $row->leq_code ? $row->leq_code : '';
            });
            $table->editColumn('jimara_dengderan', function ($row) {
                return $row->jimara_dengderan ? $row->jimara_dengderan : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'layene_siyasi']);

            return $table->make(true);
        }

        $layenetsiyasis = Layenetsiyasi::get();

        return view('admin.leqs.index', compact('layenetsiyasis'));
    }

    public function create()
    {
        abort_if(Gate::denies('leq_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.leqs.create', compact('layene_siyasis'));
    }

    public function store(StoreLeqRequest $request)
    {
        $leq = Leq::create($request->all());

        return redirect()->route('admin.leqs.index');
    }

    public function edit(Leq $leq)
    {
        abort_if(Gate::denies('leq_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $layene_siyasis = Layenetsiyasi::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $leq->load('layene_siyasi');

        return view('admin.leqs.edit', compact('layene_siyasis', 'leq'));
    }

    public function update(UpdateLeqRequest $request, Leq $leq)
    {
        $leq->update($request->all());

        return redirect()->route('admin.leqs.index');
    }

    public function show(Leq $leq)
    {
        abort_if(Gate::denies('leq_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leq->load('layene_siyasi');

        return view('admin.leqs.show', compact('leq'));
    }

    public function destroy(Leq $leq)
    {
        abort_if(Gate::denies('leq_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leq->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeqRequest $request)
    {
        Leq::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
