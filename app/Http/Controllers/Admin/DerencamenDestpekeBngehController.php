<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDerencamenDestpekeBngehRequest;
use App\Http\Requests\StoreDerencamenDestpekeBngehRequest;
use App\Http\Requests\UpdateDerencamenDestpekeBngehRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DerencamenDestpekeBngehController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('derencamen_destpeke_bngeh_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekeBngehs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('derencamen_destpeke_bngeh_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekeBngehs.create');
    }

    public function store(StoreDerencamenDestpekeBngehRequest $request)
    {
        $derencamenDestpekeBngeh = DerencamenDestpekeBngeh::create($request->all());

        return redirect()->route('admin.derencamen-destpeke-bngehs.index');
    }

    public function edit(DerencamenDestpekeBngeh $derencamenDestpekeBngeh)
    {
        abort_if(Gate::denies('derencamen_destpeke_bngeh_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekeBngehs.edit', compact('derencamenDestpekeBngeh'));
    }

    public function update(UpdateDerencamenDestpekeBngehRequest $request, DerencamenDestpekeBngeh $derencamenDestpekeBngeh)
    {
        $derencamenDestpekeBngeh->update($request->all());

        return redirect()->route('admin.derencamen-destpeke-bngehs.index');
    }

    public function show(DerencamenDestpekeBngeh $derencamenDestpekeBngeh)
    {
        abort_if(Gate::denies('derencamen_destpeke_bngeh_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekeBngehs.show', compact('derencamenDestpekeBngeh'));
    }

    public function destroy(DerencamenDestpekeBngeh $derencamenDestpekeBngeh)
    {
        abort_if(Gate::denies('derencamen_destpeke_bngeh_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $derencamenDestpekeBngeh->delete();

        return back();
    }

    public function massDestroy(MassDestroyDerencamenDestpekeBngehRequest $request)
    {
        DerencamenDestpekeBngeh::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
