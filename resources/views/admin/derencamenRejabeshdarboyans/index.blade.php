@extends('layouts.admin')
@section('content')

<div class="card border-primary">
    <div class="card-header">
        {{ trans('cruds.derencamenRejabeshdarboyan.title') }}
    </div>
    <div class="card-body text-info">
    <form id="export" method="post" action="{{route('admin.export.rejabeshdarboyans')}}">
        @csrf
        <button style="width: 250px;" class="btn btn-primary"
                    form="export" type="submit">
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
                        @foreach($lijnas as $lijna)
                            <th>{{$lijna->jimara_dengderan}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th>
                            ده م
                        </th>
                    @foreach($lijnas as $lijna)
                        <th>{{$lijna->name}}</th>
                    @endforeach
                    <tr>
                </thead>
                <tbody>
                    @foreach($data->groupBy('time_id') as $key => $item)
                        <tr>
                            <td>
                                <!-- {{$key}} -->
                                {{$times->where('id',$key)->first()->time}}
                            </td>
            
                        @foreach($lijnas as $lijna)
                            <td>
                                {{$item->where('lijna_id', $lijna->id)->first()->jimara_beshdarboyan ?? 0}}
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
                            @foreach($lijnas as $lijna)
                            <td>
                                {{$sum_array[$lijna->id] = $data->where('lijna_id', $lijna->id)->sum('jimara_beshdarboyan')}}
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                            رێژا ده‌نگدارا یێ به‌شدار
                            </td>
                            @foreach($lijnas as $key => $lijna)
                            <td>
                                {{ $array_lijna_percent[$lijna->id] = round($sum_array[$lijna->id] / $lijna->jimara_dengderan * 100, 2)  }}%
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
                            {{ round($sum_dengan/$sum_lijna_jimara_dengderan *100, 2) }}%
                        </td>

                    </tr>
                </tfoot>
            </table>
        </p>
    </div>
    <div>
    <div id="chart_div"  style="width: 900px; height: 800px;"></div>

    @php
        $arry_for_chart = [];
        foreach($lijnas as $lijna){
            $arry_for_chart[] = ['', ''];

            $arry_for_chart[] = [$lijna->name, $array_lijna_percent[$lijna->id]];
        }
    @endphp
    </div>
</div>
<script>    

console.log(array_for_chart);
    console.log('aaaaaaaa')
</script>



@endsection


@section('scripts')
@parent


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
console.log('aaaaaaaa')
var arry_for_chart = "{{json_encode($arry_for_chart,JSON_HEX_TAG)}}";
var data     = arry_for_chart.replace( /&quot;/g, '"' ),
    jsonData = JSON.parse( data );
console.log(jsonData)


google.charts.load('current', {
  packages: ['corechart', 'bar']
});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {
  var data = google.visualization.arrayToDataTable(jsonData);
      
    

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
        bar: {groupWidth: "95%"},
  };

  var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

  chart.draw(data, options);
}

</script>
@endsection