<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWestgehRequest;
use App\Http\Requests\StoreWestgehRequest;
use App\Http\Requests\UpdateWestgehRequest;
use App\Models\Bingeh;
use App\Models\Westgeh;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class WestgehController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('westgeh_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Westgeh::with(['bingeh'])->select(sprintf('%s.*', (new Westgeh())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'westgeh_show';
                $editGate = 'westgeh_edit';
                $deleteGate = 'westgeh_delete';
                $crudRoutePart = 'westgehs';

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
            $table->editColumn('westgeh_code', function ($row) {
                return $row->westgeh_code ? $row->westgeh_code : '';
            });
            $table->editColumn('jimara_dengderan', function ($row) {
                return $row->jimara_dengderan ? $row->jimara_dengderan : '';
            });
            $table->addColumn('bingeh_name', function ($row) {
                return $row->bingeh ? $row->bingeh->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'bingeh']);

            return $table->make(true);
        }

        $bingehs = Bingeh::get();

        return view('admin.westgehs.index', compact('bingehs'));
    }

    public function create()
    {
        abort_if(Gate::denies('westgeh_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.westgehs.create', compact('bingehs'));
    }

    public function store(StoreWestgehRequest $request)
    {
        $westgeh = Westgeh::create($request->all());

        return redirect()->route('admin.westgehs.index');
    }

    public function edit(Westgeh $westgeh)
    {
        abort_if(Gate::denies('westgeh_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bingehs = Bingeh::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $westgeh->load('bingeh');

        return view('admin.westgehs.edit', compact('bingehs', 'westgeh'));
    }

    public function update(UpdateWestgehRequest $request, Westgeh $westgeh)
    {
        $westgeh->update($request->all());

        return redirect()->route('admin.westgehs.index');
    }

    public function show(Westgeh $westgeh)
    {
        abort_if(Gate::denies('westgeh_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $westgeh->load('bingeh', 'wistgehHnartnaDengans');

        return view('admin.westgehs.show', compact('westgeh'));
    }

    public function destroy(Westgeh $westgeh)
    {
        abort_if(Gate::denies('westgeh_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $westgeh->delete();

        return back();
    }

    public function massDestroy(MassDestroyWestgehRequest $request)
    {
        Westgeh::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
