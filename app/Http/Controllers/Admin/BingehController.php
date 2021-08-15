<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBingehRequest;
use App\Http\Requests\StoreBingehRequest;
use App\Http\Requests\UpdateBingehRequest;
use App\Models\Bingeh;
use App\Models\Lijna;
use App\Models\Rekxraw;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BingehController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('bingeh_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bingeh::with(['lijna', 'rekxraw'])->select(sprintf('%s.*', (new Bingeh())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bingeh_show';
                $editGate = 'bingeh_edit';
                $deleteGate = 'bingeh_delete';
                $crudRoutePart = 'bingehs';

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
            $table->editColumn('bingeh_code', function ($row) {
                return $row->bingeh_code ? $row->bingeh_code : '';
            });
            $table->editColumn('jimara_dengderan', function ($row) {
                return $row->jimara_dengderan ? $row->jimara_dengderan : '';
            });
            $table->addColumn('lijna_name', function ($row) {
                return $row->lijna ? $row->lijna->name : '';
            });

            $table->addColumn('rekxraw_name', function ($row) {
                return $row->rekxraw ? $row->rekxraw->name : '';
            });

            $table->editColumn('jimara_rekxistiya', function ($row) {
                return $row->jimara_rekxistiya ? $row->jimara_rekxistiya : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lijna', 'rekxraw']);

            return $table->make(true);
        }

        $lijnas   = Lijna::get();
        $rekxraws = Rekxraw::get();

        return view('admin.bingehs.index', compact('lijnas', 'rekxraws'));
    }

    public function create()
    {
        abort_if(Gate::denies('bingeh_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rekxraws = Rekxraw::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bingehs.create', compact('lijnas', 'rekxraws'));
    }

    public function store(StoreBingehRequest $request)
    {
        $bingeh = Bingeh::create($request->all());

        return redirect()->route('admin.bingehs.index');
    }

    public function edit(Bingeh $bingeh)
    {
        abort_if(Gate::denies('bingeh_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rekxraws = Rekxraw::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $bingeh->load('lijna', 'rekxraw');

        return view('admin.bingehs.edit', compact('lijnas', 'rekxraws', 'bingeh'));
    }

    public function update(UpdateBingehRequest $request, Bingeh $bingeh)
    {
        $bingeh->update($request->all());

        return redirect()->route('admin.bingehs.index');
    }

    public function show(Bingeh $bingeh)
    {
        abort_if(Gate::denies('bingeh_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bingeh->load('lijna', 'rekxraw', 'bingehHnartnaDengans', 'bingehDaxlkrnaDengenKandidas');

        return view('admin.bingehs.show', compact('bingeh'));
    }

    public function destroy(Bingeh $bingeh)
    {
        abort_if(Gate::denies('bingeh_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bingeh->delete();

        return back();
    }

    public function massDestroy(MassDestroyBingehRequest $request)
    {
        Bingeh::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
