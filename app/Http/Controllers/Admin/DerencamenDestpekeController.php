<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDerencamenDestpekeRequest;
use App\Http\Requests\StoreDerencamenDestpekeRequest;
use App\Http\Requests\UpdateDerencamenDestpekeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DerencamenDestpekeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('derencamen_destpeke_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('derencamen_destpeke_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekes.create');
    }

    public function store(StoreDerencamenDestpekeRequest $request)
    {
        $derencamenDestpeke = DerencamenDestpeke::create($request->all());

        return redirect()->route('admin.derencamen-destpekes.index');
    }

    public function edit(DerencamenDestpeke $derencamenDestpeke)
    {
        abort_if(Gate::denies('derencamen_destpeke_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekes.edit', compact('derencamenDestpeke'));
    }

    public function update(UpdateDerencamenDestpekeRequest $request, DerencamenDestpeke $derencamenDestpeke)
    {
        $derencamenDestpeke->update($request->all());

        return redirect()->route('admin.derencamen-destpekes.index');
    }

    public function show(DerencamenDestpeke $derencamenDestpeke)
    {
        abort_if(Gate::denies('derencamen_destpeke_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekes.show', compact('derencamenDestpeke'));
    }

    public function destroy(DerencamenDestpeke $derencamenDestpeke)
    {
        abort_if(Gate::denies('derencamen_destpeke_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $derencamenDestpeke->delete();

        return back();
    }

    public function massDestroy(MassDestroyDerencamenDestpekeRequest $request)
    {
        DerencamenDestpeke::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
