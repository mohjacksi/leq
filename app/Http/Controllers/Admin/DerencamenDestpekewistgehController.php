<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDerencamenDestpekewistgehRequest;
use App\Http\Requests\StoreDerencamenDestpekewistgehRequest;
use App\Http\Requests\UpdateDerencamenDestpekewistgehRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DerencamenDestpekewistgehController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('derencamen_destpekewistgeh_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekewistgehs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('derencamen_destpekewistgeh_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekewistgehs.create');
    }

    public function store(StoreDerencamenDestpekewistgehRequest $request)
    {
        $derencamenDestpekewistgeh = DerencamenDestpekewistgeh::create($request->all());

        return redirect()->route('admin.derencamen-destpekewistgehs.index');
    }

    public function edit(DerencamenDestpekewistgeh $derencamenDestpekewistgeh)
    {
        abort_if(Gate::denies('derencamen_destpekewistgeh_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekewistgehs.edit', compact('derencamenDestpekewistgeh'));
    }

    public function update(UpdateDerencamenDestpekewistgehRequest $request, DerencamenDestpekewistgeh $derencamenDestpekewistgeh)
    {
        $derencamenDestpekewistgeh->update($request->all());

        return redirect()->route('admin.derencamen-destpekewistgehs.index');
    }

    public function show(DerencamenDestpekewistgeh $derencamenDestpekewistgeh)
    {
        abort_if(Gate::denies('derencamen_destpekewistgeh_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenDestpekewistgehs.show', compact('derencamenDestpekewistgeh'));
    }

    public function destroy(DerencamenDestpekewistgeh $derencamenDestpekewistgeh)
    {
        abort_if(Gate::denies('derencamen_destpekewistgeh_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $derencamenDestpekewistgeh->delete();

        return back();
    }

    public function massDestroy(MassDestroyDerencamenDestpekewistgehRequest $request)
    {
        DerencamenDestpekewistgeh::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
