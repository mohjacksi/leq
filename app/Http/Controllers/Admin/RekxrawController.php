<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRekxrawRequest;
use App\Http\Requests\StoreRekxrawRequest;
use App\Http\Requests\UpdateRekxrawRequest;
use App\Models\Lijna;
use App\Models\Rekxraw;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class RekxrawController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('rekxraw_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Rekxraw::with(['lijna'])->select(sprintf('%s.*', (new Rekxraw())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'rekxraw_show';
                $editGate = 'rekxraw_edit';
                $deleteGate = 'rekxraw_delete';
                $crudRoutePart = 'rekxraws';

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
            $table->editColumn('code_rekxraw', function ($row) {
                return $row->code_rekxraw ? $row->code_rekxraw : '';
            });
            $table->addColumn('lijna_name', function ($row) {
                return $row->lijna ? $row->lijna->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'lijna']);

            return $table->make(true);
        }

        $lijnas = Lijna::get();

        return view('admin.rekxraws.index', compact('lijnas'));
    }

    public function create()
    {
        abort_if(Gate::denies('rekxraw_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.rekxraws.create', compact('lijnas'));
    }

    public function store(StoreRekxrawRequest $request)
    {
        $rekxraw = Rekxraw::create($request->all());

        return redirect()->route('admin.rekxraws.index');
    }

    public function edit(Rekxraw $rekxraw)
    {
        abort_if(Gate::denies('rekxraw_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $lijnas = Lijna::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $rekxraw->load('lijna');

        return view('admin.rekxraws.edit', compact('lijnas', 'rekxraw'));
    }

    public function update(UpdateRekxrawRequest $request, Rekxraw $rekxraw)
    {
        $rekxraw->update($request->all());

        return redirect()->route('admin.rekxraws.index');
    }

    public function show(Rekxraw $rekxraw)
    {
        abort_if(Gate::denies('rekxraw_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rekxraw->load('lijna');

        return view('admin.rekxraws.show', compact('rekxraw'));
    }

    public function destroy(Rekxraw $rekxraw)
    {
        abort_if(Gate::denies('rekxraw_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rekxraw->delete();

        return back();
    }

    public function massDestroy(MassDestroyRekxrawRequest $request)
    {
        Rekxraw::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
