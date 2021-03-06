<?php

namespace App\Http\Controllers\Admin;

use App\Exports\DengenKandidaExport;
use App\Exports\RejaBeshdarboyanExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyWebSiteViewRequest;
use App\Http\Requests\StoreWebSiteViewRequest;
use App\Http\Requests\UpdateWebSiteViewRequest;
use App\Models\DaxlkrnaDengenKandida;
use App\Models\Lijna;
use App\Models\RejaBeshdarboyan;
use App\Models\Time;
use Gate;
use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class WebSiteViewController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('web_site_view_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');


        $all_total = Lijna::sum('jimara_dengderan');
        $votes_total = DaxlkrnaDengenKandida::sum('jimara_dengan');
        $total_percent = round($votes_total / $all_total * 100, 2);




        $total_voats = DaxlkrnaDengenKandida::sum('jimara_dengan');
        $total_each_party = DaxlkrnaDengenKandida::with(['layenesiyasi', 'media'])->groupBy('layenesiyasi_id')
            ->selectRaw('layenesiyasi_id, sum(jimara_dengan) as total')->get();
        $total_parties = $total_each_party->sum('total');

        $total_each_candidate = DaxlkrnaDengenKandida::with(['jimara_kandidi', 'media'])->groupBy('jimara_kandidi_id')
            ->selectRaw('jimara_kandidi_id, sum(jimara_dengan) as total')->get();
        $total_candidates = $total_each_candidate->sum('total');
        $total_each_candidate_best = $total_each_candidate->sortByDesc('total')->take(4);
        $total_candidate_others = $total_candidates - $total_each_candidate_best->sum('total');
        $total_each_candidate_best = $total_each_candidate_best->toArray();
        $total_each_candidate_best[] = ['total' => $total_candidate_others, 'jimara_kandidi' => ['nav' => 'others']];
        //dd($total_each_candidate_best);

        //dd($total_each_party[0]->ala->media->getUrl());
        //dd($total_each_party[0]->layenesiyasi->name);

        $total_candidate_best_chart = [['', '']];
        foreach ($total_each_candidate_best as $total_candidate_best) {
            $total_candidate_best_chart[] = [
                $total_candidate_best['jimara_kandidi']['nav'] ?? '',
                intval($total_candidate_best['total']) ?? 0
            ];
            //round(($total_candidate_best['total'] / $total_candidates) * 100, 2)
        }


        //


        return view('admin.webSiteViews.index')->with([
            'all_total' => $all_total,
            'votes_total' => $votes_total,
            'total_percent' => $total_percent,
            'total_voats' => $total_voats,
            'total_each_party' => $total_each_party,
            'total_parties' => $total_parties,
            'total_each_candidate' => $total_each_candidate,
            'total_candidates' => $total_candidates,
            'total_each_candidate_best' => $total_each_candidate_best,
            'total_candidate_best_chart' => $total_candidate_best_chart,
            'total_candidate_others' => $total_candidate_others,
        ]);
    }

    //WebSiteViewController::getStyle
    static function getStyle($num)
    {
        if ($num < 0) {
            $num *= -1;
        }
        $colors = ['#FDF734', '#92D050', '#F7BE8F', '#C4D79B', '#F1F3E3', '#E26C2D', '#92CDDC', '#CCC0DA', '#B1A0C7', '#D9D9D9', '#E6B8B7', '#8064A2', '#DCE6F1'];
        $colors_count = count($colors);
        $color = $colors[$num % $colors_count];
        return 'background-color: ' . $color . '; width: 15px; height: 30px;text-align: center; border:4px solid #000000;';
    }

    public function export()
    {
        /*$times = Time::orderBy('id')->get();
        $lijnas = Lijna::all();
        $data = [];
        $collection = RejaBeshdarboyan::select('lijna_id', 'time_id', 'jimara_beshdarboyan')

            ->orderBy('time_id')
            ->get();


        $data = $collection;*/

        $data = DaxlkrnaDengenKandida::query()
            ->with(['lijna', 'bingeh', 'layenesiyasi', 'jimara_kandidi'])
            ->get();


        //return view('admin.webSiteViews.export', compact('data'));
        return Excel::download(new DengenKandidaExport($data), 'DengenKandida.xlsx');
    }

    public function create()
    {
        abort_if(Gate::denies('web_site_view_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.webSiteViews.create');
    }

    public function store(StoreWebSiteViewRequest $request)
    {
        $webSiteView = WebSiteView::create($request->all());

        return redirect()->route('admin.web-site-views.index');
    }

    public function edit(WebSiteView $webSiteView)
    {
        abort_if(Gate::denies('web_site_view_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.webSiteViews.edit', compact('webSiteView'));
    }

    public function update(UpdateWebSiteViewRequest $request, WebSiteView $webSiteView)
    {
        $webSiteView->update($request->all());

        return redirect()->route('admin.web-site-views.index');
    }

    public function show(WebSiteView $webSiteView)
    {
        abort_if(Gate::denies('web_site_view_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.webSiteViews.show', compact('webSiteView'));
    }

    public function destroy(WebSiteView $webSiteView)
    {
        abort_if(Gate::denies('web_site_view_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webSiteView->delete();

        return back();
    }

    public function massDestroy(MassDestroyWebSiteViewRequest $request)
    {
        WebSiteView::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
