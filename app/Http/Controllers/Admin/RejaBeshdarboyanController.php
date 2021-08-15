<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRejaBeshdarboyanRequest;
use App\Http\Requests\StoreRejaBeshdarboyanRequest;
use App\Http\Requests\UpdateRejaBeshdarboyanRequest;
use App\Models\Bingeh;
use App\Models\Leq;
use App\Models\Lijna;
use App\Models\RejaBeshdarboyan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RejaBeshdarboyanController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('reja_beshdarboyan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = RejaBeshdarboyan::with(['leq', 'lijna', 'bingeh'])->select(sprintf('%s.*', (new RejaBeshdarboyan())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'reja_beshdarboyan_show';
                $editGate = 'reja_beshdarboyan_edit';
                $deleteGate = 'reja_beshdarboyan_delete';
                $crudRoutePart = 'reja-beshdarboyans';

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

            $table->editColumn('demjimer', function ($row) {
                return $row->demjimer ? $row->demjimer : '';
            });
            $table->editColumn('jimara_beshdarboyan', function ($row) {
                return $row->jimara_beshdarboyan ? $row->jimara_beshdarboyan : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'leq', 'lijna', 'bingeh']);

            return $table->make(true);
        }

        $leqs    = Leq::get();
        $lijnas  = Lijna::get();
        $bingehs = Bingeh::get();

        return view('admin.rejaBeshdarboyans.index', compact('leqs', 'lijnas', 'bingehs'));
    }

    public function create()
    {
        abort_if(Gate::denies('reja_beshdarboyan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rejaBeshdarboyans.create', compact('leqs', 'lijnas', 'bingehs'));
    }

    public function store(StoreRejaBeshdarboyanRequest $request)
    {
        $rejaBeshdarboyan = RejaBeshdarboyan::create($request->all());

        return redirect()->route('admin.reja-beshdarboyans.index');
    }

    public function edit(RejaBeshdarboyan $rejaBeshdarboyan)
    {
        abort_if(Gate::denies('reja_beshdarboyan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $leqs = Leq::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rejaBeshdarboyan->load('leq', 'lijna', 'bingeh');

        return view('admin.rejaBeshdarboyans.edit', compact('leqs', 'lijnas', 'bingehs', 'rejaBeshdarboyan'));
    }

    public function update(UpdateRejaBeshdarboyanRequest $request, RejaBeshdarboyan $rejaBeshdarboyan)
    {
        $rejaBeshdarboyan->update($request->all());

        return redirect()->route('admin.reja-beshdarboyans.index');
    }

    public function show(RejaBeshdarboyan $rejaBeshdarboyan)
    {
        abort_if(Gate::denies('reja_beshdarboyan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rejaBeshdarboyan->load('leq', 'lijna', 'bingeh');

        return view('admin.rejaBeshdarboyans.show', compact('rejaBeshdarboyan'));
    }

    public function destroy(RejaBeshdarboyan $rejaBeshdarboyan)
    {
        abort_if(Gate::denies('reja_beshdarboyan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rejaBeshdarboyan->delete();

        return back();
    }

    public function massDestroy(MassDestroyRejaBeshdarboyanRequest $request)
    {
        RejaBeshdarboyan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
