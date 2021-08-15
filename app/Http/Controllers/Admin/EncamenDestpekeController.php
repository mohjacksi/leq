<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEncamenDestpekeRequest;
use App\Http\Requests\StoreEncamenDestpekeRequest;
use App\Http\Requests\UpdateEncamenDestpekeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EncamenDestpekeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('encamen_destpeke_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.encamenDestpekes.index');
    }

    public function create()
    {
        abort_if(Gate::denies('encamen_destpeke_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.encamenDestpekes.create');
    }

    public function store(StoreEncamenDestpekeRequest $request)
    {
        $encamenDestpeke = EncamenDestpeke::create($request->all());

        return redirect()->route('admin.encamen-destpekes.index');
    }

    public function edit(EncamenDestpeke $encamenDestpeke)
    {
        abort_if(Gate::denies('encamen_destpeke_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.encamenDestpekes.edit', compact('encamenDestpeke'));
    }

    public function update(UpdateEncamenDestpekeRequest $request, EncamenDestpeke $encamenDestpeke)
    {
        $encamenDestpeke->update($request->all());

        return redirect()->route('admin.encamen-destpekes.index');
    }

    public function show(EncamenDestpeke $encamenDestpeke)
    {
        abort_if(Gate::denies('encamen_destpeke_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.encamenDestpekes.show', compact('encamenDestpeke'));
    }

    public function destroy(EncamenDestpeke $encamenDestpeke)
    {
        abort_if(Gate::denies('encamen_destpeke_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $encamenDestpeke->delete();

        return back();
    }

    public function massDestroy(MassDestroyEncamenDestpekeRequest $request)
    {
        EncamenDestpeke::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
