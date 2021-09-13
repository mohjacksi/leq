@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('cruds.webSiteView.title') }}
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-12 text-center">
                    <h3>ئەنجامێن هەلبژارتنین پەرلەمانێ عیراقێ
                    </h3>

                    <h3>سەرجەمێ گشتی ئێن دەنگان:
                        {{ $all_total ?? '' }}
                    </h3>

                    <h3>دەنگێن هاتینە ڤاڤارتن : {{ $votes_total ?? '' }}

                        ب رێژا {{ $total_percent ?? '' }}٪ :


                    </h3>
                    <div>
                        @php
                            $arry_for_chart = [['','']];
                            foreach ($total_each_party as $id => $total_party) {
                                $name = $total_party->layenesiyasi->name;
                                $percent = round(($total_party->total / $total_parties) * 100, 2);
                                $arry_for_chart[] = [$name, $percent];
                            
                                //$array_for_pie_chart[$lijna->id] = [['Task', '' . $lijna->id], ['went', $array_lijna_percent[$lijna->id]], ['didnt', 100 - $array_lijna_percent[$lijna->id]]];
                            }
                            //dd($arry_for_chart);
                        @endphp
                        <div class="form-row">
                            <div class="form-group col-md-12 border border-primary" id="piechart_overall"
                                style="width: 900px; height: 500px;">
                            </div>

                        @section('scripts')
                            @parent
                            <script type="text/javascript">
                                google.charts.load('current', {
                                    'packages': ['corechart']
                                });
                                google.charts.setOnLoadCallback(drawChart);


                                var arry_for_pie_chart_overall,
                                    data = [];
                                arry_for_pie_chart_overall =
                                    "{{ json_encode($arry_for_chart ?? '', JSON_HEX_TAG) }}";
                                data['overall'] = arry_for_pie_chart_overall.replace(/&quot;/g, '"'),
                                    jsonData['overall'] = JSON.parse(data['overall']);

                                console.log(data['overall']);

                                function drawChart() {
                                    var data = google.visualization.arrayToDataTable(jsonData['overall']);

                                    var options = {
                                        title: 'overall overall',
                                        fontSize: 18,
                                        legend: {
                                            position: 'right',
                                            textStyle: {
                                                color: 'blue',
                                                fontSize: 16
                                            }
                                        },

                                    };

                                    var chart = new google.visualization.PieChart(document.getElementById('piechart_overall'));

                                    chart.draw(data, options);
                                }
                            </script>
                        @endsection

                    </div>
                    <div class="d-none">
                        ...<br>
                        @foreach ($total_each_party as $total_party)
                            <h3>
                                {{ $total_party->layenesiyasi->name ?? '' }}: {{ $total_party->total }}:
                                %{{ round(($total_party->total / $total_parties) * 100, 2) }}
                            </h3>

                        @endforeach
                        ...<br>
                        @foreach ($total_each_candidate->all() as $total_candidate)
                            <h3>
                                {{ $total_candidate->jimara_kandidi->nav ?? '' }}: {{ $total_candidate->total }}:
                                %{{ round(($total_candidate->total / $total_candidates) * 100, 2) }}
                            </h3>
                        @endforeach
                        ...<br>
                        @foreach ($total_each_candidate_best as $total_candidate_best)
                            <h3>
                                {{ $total_candidate_best['jimara_kandidi']['nav'] ?? '' }}:
                                {{ $total_candidate_best['total'] ?? '' }}:
                                %{{ round(($total_candidate_best['total'] / $total_candidates) * 100, 2) }}
                            </h3>
                        @endforeach

                    </div>
                </div>

            </div>
            <div class="card-header">
                لایەنین سیاسی </div>

            <h1 class="text-center">لایەنین سیاسی</h1>

            @foreach ($total_each_party as $id => $total_party)
                @if ($id % 3 == 0)
                    <div class="form-row">
                @endif
                <div class="form-group col-md-4 border border-primary">
                    @foreach ($total_party->layenesiyasi->ala as $key => $media)
                        <div class="text-center">

                            <a class="text-center" href="{{ $media->getUrl() }}" target="_blank">
                                <img class="img-fluid" src="{{ $media->getUrl() }}">
                            </a>
                        </div>
                    @endforeach

                    <h3 class="text-center">
                        {{ $total_party->layenesiyasi->name ?? '' }}

                    </h3>
                    <h3 class="text-center">
                        دەنگ {{ $total_party->total }}

                    </h3>
                    <h3 class="text-center">
                        %{{ $percent = round(($total_party->total / $total_parties) * 100, 2) }}
                    </h3>
                </div>


                @if ($id % 3 == 2)
        </div>
        @endif
        @endforeach
    </div>
    <div class="card-header">
        کاندیدان </div>
    <br><br><br><br>
    <h1 class="text-center">کاندیدان</h1>
    <div id="chart_div" style="width: 900px; height: 800px;"></div>

    <div class="card-header">
        کاندیدان </div>
    <br><br><br><br>
    <h1 class="text-center">کاندیدان</h1>
    @foreach ($total_each_candidate->all() as $id => $total_candidate)
        @if ($id % 3 == 0)
            <div class="form-row row">
        @endif
        <div class="form-group col-md-4 border border-primary">
            <div class="text-center">
                @if (isset($total_candidate->jimara_kandidi->wene))
                    <a class="text-center"
                        href="{{ $total_candidate->jimara_kandidi->wene->first()->getUrl() ?? '' }}" target="_blank">
                        <img class="img-fluid"
                            src="{{ $total_candidate->jimara_kandidi->wene->first()->getUrl() ?? '' }}">
                    </a>
                @endif
            </div>

            <h3 class="text-center">
                {{ $total_candidate->jimara_kandidi->nav ?? '' }}

            </h3>
            <h3 class="text-center">
                دەنگ {{ $total_candidate->total }}

            </h3>
            <h3 class="text-center">
                %{{ round(($total_candidate->total / $total_parties) * 100, 2) }}
            </h3>
        </div>


        @if ($id % 3 == 2)
</div>
@endif
@endforeach
</div>
</div>



@endsection



@section('scripts')
@parent
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


<script>
    var arry_for_chart = "{{ json_encode($total_candidate_best_chart, JSON_HEX_TAG) }}";
    var data = arry_for_chart.replace(/&quot;/g, '"'),
        jsonDataChart = JSON.parse(data);
    //this to make the pie chart works!!
    console.log(data);
    var jsonData = JSON.parse(data)
    console.log(jsonDataChart)


    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {
        var data = google.visualization.arrayToDataTable(jsonDataChart);

        var options = {
            width: 800,
            title: 'رێژا بەژداربویان ل هەر لژنەیەکی ',
            chartArea: {
                width: '80%'
            },
            hAxis: {
                title: 'سه رجه م',
                minValue: 0
            },
            vAxis: {
                title: 'ده نك'
            },
            width: 800,
            height: 800,
            bar: {
                groupWidth: "95%"
            },
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>


@endsection
