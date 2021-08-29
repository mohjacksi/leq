<?php

namespace App\Http\Controllers\Admin;

use App\Exports\RejaBeshdarboyanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDerencamenRejabeshdarboyanRequest;
use App\Http\Requests\StoreDerencamenRejabeshdarboyanRequest;
use App\Http\Requests\UpdateDerencamenRejabeshdarboyanRequest;
use App\Models\Lijna;
use App\Models\RejaBeshdarboyan;
use App\Models\Time;
use Gate;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class DerencamenRejabeshdarboyanController extends Controller
{
    public function index()
    {
        $times = Time::orderBy('id')->get();
        $lijnas = Lijna::all();
        $data = [];
        $collection = RejaBeshdarboyan::select('lijna_id','time_id','jimara_beshdarboyan')
            
            ->orderBy('time_id')
            ->get();
        
        
        // foreach($collection as $item){
        //     $data[$item->time_id][$item->lijna_id] = $item->jimara_beshdarboyan;            
        // }
        $data = $collection;
        return view('admin.derencamenRejabeshdarboyans.index',compact('lijnas','times','data'));

    }
    public function export()
    {
        $times = Time::orderBy('id')->get();
        $lijnas = Lijna::all();
        $data = [];
        $collection = RejaBeshdarboyan::select('lijna_id','time_id','jimara_beshdarboyan')
            
            ->orderBy('time_id')
            ->get();
        
        
        $data = $collection;
        //return view('admin.derencamenRejabeshdarboyans.index',compact('lijnas','times','data'));
        return Excel::download(new RejaBeshdarboyanExport($data, $times, $lijnas), 'derencamen-rejabeshdarboyans.xlsx');

    }

    // public function index()
    // {
    //     $this->getReport();
    //     abort_if(Gate::denies('derencamen_rejabeshdarboyan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     return view('admin.derencamenRejabeshdarboyans.index');
    // }

    public function create()
    {
        abort_if(Gate::denies('derencamen_rejabeshdarboyan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenRejabeshdarboyans.create');
    }

    public function store(StoreDerencamenRejabeshdarboyanRequest $request)
    {
        $derencamenRejabeshdarboyan = DerencamenRejabeshdarboyan::create($request->all());

        return redirect()->route('admin.derencamen-rejabeshdarboyans.index');
    }

    public function edit(DerencamenRejabeshdarboyan $derencamenRejabeshdarboyan)
    {
        abort_if(Gate::denies('derencamen_rejabeshdarboyan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenRejabeshdarboyans.edit', compact('derencamenRejabeshdarboyan'));
    }

    public function update(UpdateDerencamenRejabeshdarboyanRequest $request, DerencamenRejabeshdarboyan $derencamenRejabeshdarboyan)
    {
        $derencamenRejabeshdarboyan->update($request->all());

        return redirect()->route('admin.derencamen-rejabeshdarboyans.index');
    }

    public function show(DerencamenRejabeshdarboyan $derencamenRejabeshdarboyan)
    {
        abort_if(Gate::denies('derencamen_rejabeshdarboyan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.derencamenRejabeshdarboyans.show', compact('derencamenRejabeshdarboyan'));
    }

    public function destroy(DerencamenRejabeshdarboyan $derencamenRejabeshdarboyan)
    {
        abort_if(Gate::denies('derencamen_rejabeshdarboyan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $derencamenRejabeshdarboyan->delete();

        return back();
    }

    public function massDestroy(MassDestroyDerencamenRejabeshdarboyanRequest $request)
    {
        DerencamenRejabeshdarboyan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
