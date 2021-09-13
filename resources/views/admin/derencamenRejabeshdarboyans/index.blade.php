@extends('layouts.admin')
@section('content')

    <div class="card border-primary">
        <div class="card-header">
            {{ trans('cruds.derencamenRejabeshdarboyan.title') }}
        </div>
        <div class="card-body text-info">
            <form id="export" method="post" action="{{ route('admin.export.rejabeshdarboyans') }}">
                @csrf
                <button style="width: 250px;" class="btn btn-primary" form="export" type="submit">
                    تصدير
                </button>

            </form>
        </div>

        <div class="card-body text-info">
            <p>
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            سه‌رجه‌مێ گشتى یێ ده‌نگدرا
                        </th>
                        @foreach ($lijnas as $lijna)
                            <th>{{ $lijna->jimara_dengderan }}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>
                            ده م
                        </th>
                        @foreach ($lijnas as $lijna)
                            <th>{{ $lijna->name }}</th>
                        @endforeach
                    <tr>
                </thead>
                <tbody>
                    @foreach ($data->groupBy('time_id') as $key => $item)
                        <tr>
                            <td>
                                <!-- {{ $key }} -->
                                {{ $times->where('id', $key)->first()->time }}
                            </td>

                            @foreach ($lijnas as $lijna)
                                <td>
                                    {{ $item->where('lijna_id', $lijna->id)->first()->jimara_beshdarboyan ?? 0 }}
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    <tr>
                        <td>
                            سه‌رجه‌مێ ده‌نگده‌رێن
                            به‌شداربوین
                        </td>
                        @php
                            $sum_array = [];
                            $sum_lijna_jimara_dengderan = 0;
                            $sum_dengan = 0;
                            $array_lijna_percent = [];
                        @endphp
                        @foreach ($lijnas as $lijna)
                            <td>
                                {{ $sum_array[$lijna->id] = $data->where('lijna_id', $lijna->id)->sum('jimara_beshdarboyan') }}
                            </td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>
                            رێژا ده‌نگدارا یێ به‌شدار
                        </td>
                        @foreach ($lijnas as $key => $lijna)
                            <td>
                                {{ $array_lijna_percent[$lijna->id] = round(($sum_array[$lijna->id] / $lijna->jimara_dengderan) * 100, 2) }}%
                                @php
                                    $sum_lijna_jimara_dengderan += $lijna->jimara_dengderan;
                                    $sum_dengan += $sum_array[$lijna->id];
                                @endphp
                            </td>
                        @endforeach
                    </tr>


                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">
                            سه‌رجه‌مێ گشتى یێن ده‌نگدرا
                        </td>
                        <td>
                            {{ $sum_lijna_jimara_dengderan }}
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2">
                            سه‌رجه‌مێ گشتى یێن ده‌نگده‌ریێن به‌شداربوین
                        </td>
                        <td>
                            {{ $sum_dengan }}
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2">
                            رێژا گشتى یێن ده‌نگده‌ریێ به‌شداربوین
                        </td>
                        <td>
                            {{ round(($sum_dengan / $sum_lijna_jimara_dengderan) * 100, 2) }}%
                        </td>

                    </tr>
                </tfoot>
            </table>
            </p>
        </div>
        <div>
            @php
                $arry_for_chart = [];
                foreach ($lijnas as $lijna) {
                    $arry_for_chart[] = ['', ''];
                    $arry_for_chart[] = [$lijna->name, $array_lijna_percent[$lijna->id]];
                
                    $array_for_pie_chart[$lijna->id] = [['Task', '' . $lijna->id], ['went', $array_lijna_percent[$lijna->id]], ['didnt', 100 - $array_lijna_percent[$lijna->id]]];
                }
                
                $arry_for_overall = ['Overall', '0'];
                
                $array_for_pie_overall = [['Task', ''], ['went', $went_total_percent], ['didnt', $unwent_total_percent]];
                //dd($array_for_pie_overall);
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
                        "{{ json_encode($array_for_pie_overall, JSON_HEX_TAG) }}";
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


        @foreach ($lijnas as $id => $lijna)
            @if ($id % 2 == 0)
                <div class="form-row">
            @endif
            <div class="form-group col-md-6 border border-primary" id="piechart{{ $id }}"
                style="width: 900px; height: 500px;">
            </div>
            @section('scripts')
                @parent
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['corechart']
                    });
                    google.charts.setOnLoadCallback(drawChart);


                    var arry_for_pie_chart = [],
                        data = [];
                    arry_for_pie_chart['{{ $lijna->id }}'] =
                        "{{ json_encode($array_for_pie_chart[$lijna->id], JSON_HEX_TAG) }}";
                    data['{{ $lijna->id }}'] = arry_for_pie_chart['{{ $lijna->id }}'].replace(/&quot;/g, '"'),
                        jsonData['{{ $lijna->id }}'] = JSON.parse(data['{{ $lijna->id }}']);
                    console.log("jsonData['{{ $lijna->id }}']")

                    console.log(jsonData['{{ $lijna->id }}'])


                    function drawChart() {
                        var data = google.visualization.arrayToDataTable(jsonData['{{ $lijna->id }}']);

                        var options = {
                            title: '{{ $lijna->name }} {{ $lijna->id }}',
                            fontSize: 18,
                            legend: {
                                position: 'right',
                                textStyle: {
                                    color: 'blue',
                                    fontSize: 16
                                }
                            },
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart{{ $id }}'));

                        chart.draw(data, options);
                    }
                </script>
            @endsection
            @if ($id % 2 == 1)
    </div>
    @endif
    @endforeach




    <div class="border border-primary" id="chart_div" style="width: 900px; height: 800px;"></div>

</div>
</div>
@endsection


@section('scripts')
@parent
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>




<script>
    var arry_for_chart = "{{ json_encode($arry_for_chart, JSON_HEX_TAG) }}";
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
                title: 'لژنان'
            },
            width: 800,
            height: 800,
            bar: {
                groupWidth: "95%"
            },
            fontSize: 18,
            legend: {
                position: 'right',
                textStyle: {
                    color: 'blue',
                    fontSize: 16
                }
            },

        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));

        chart.draw(data, options);
    }
</script>


@endsection
