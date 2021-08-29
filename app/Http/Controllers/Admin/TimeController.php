<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTimeRequest;
use App\Http\Requests\StoreTimeRequest;
use App\Http\Requests\UpdateTimeRequest;
use App\Models\Time;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('time_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Time::query()->select(sprintf('%s.*', (new Time())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'time_show';
                $editGate = 'time_edit';
                $deleteGate = 'time_delete';
                $crudRoutePart = 'times';

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
            $table->editColumn('time', function ($row) {
                return $row->time ? $row->time : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.times.index');
    }

    public function create()
    {
        abort_if(Gate::denies('time_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.times.create');
    }

    public function store(StoreTimeRequest $request)
    {
        $time = Time::create($request->all());

        return redirect()->route('admin.times.index');
    }

    public function edit(Time $time)
    {
        abort_if(Gate::denies('time_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.times.edit', compact('time'));
    }

    public function update(UpdateTimeRequest $request, Time $time)
    {
        $time->update($request->all());

        return redirect()->route('admin.times.index');
    }

    public function show(Time $time)
    {
        abort_if(Gate::denies('time_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.times.show', compact('time'));
    }

    public function destroy(Time $time)
    {
        abort_if(Gate::denies('time_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $time->delete();

        return back();
    }

    public function massDestroy(MassDestroyTimeRequest $request)
    {
        Time::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
