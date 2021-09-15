@php
use App\Http\Controllers\Admin\WebSiteViewController;
$layan = '<tr>';

$footer = '<tr><td colspan="6"></td>';
$footer2 = '<tr><td colspan="6"></td>';
$kandids = [];
$kandids_colors = [];
$colors = ['#FDF734', '#92D050', '#F7BE8F', '#C4D79B', '#F1F3E3', '#E26C2D', '#92CDDC', '#CCC0DA', '#B1A0C7', '#D9D9D9', '#E6B8B7', '#8064A2', '#DCE6F1'];
$colors_count = count($colors);
$colors_counter = 0;

@endphp

<table class='table table-bordered'>
    <thead>
        <tr>
            <th rowspan='2' style="{{ WebSiteViewController::getStyle(3) }}">
                بنگه‌هـ
            </th>
            <th rowspan='2' style="{{ WebSiteViewController::getStyle(4) }}">
                لیژنه‌
            </th>

            <th rowspan='2' style="{{ WebSiteViewController::getStyle(5) }}">
                سه‌رجه‌م
            </th>
            <th rowspan='2' style="{{ WebSiteViewController::getStyle(6) }}">
                بةشداربون
            </th>
            <th rowspan='2' style="{{ WebSiteViewController::getStyle(7) }}">
                پوچه‌ل
            </th>
            <th rowspan='2' style="{{ WebSiteViewController::getStyle(8) }}">
                دنكی درست
            </th>



            @foreach ($data->groupBy(['layan', 'kandid']) as $key => $value)
                <th colspan="{{ $value->count() }}" style="{{ WebSiteViewController::getStyle($colors_counter) }}">
                    {{ $key }}
                    @foreach ($value as $k => $v)
                        @php
                            $layan .= '<th style="' . WebSiteViewController::getStyle($colors_counter) . '">' . $k . '</th>';
                            $kandids[] = $v->first()->jimara_kandidi_id;
                            $kandids_colors[] = $colors_counter;
                            $footer .= '<td style="' . WebSiteViewController::getStyle($colors_counter) . '">' . $v->sum('jimara_dengan') . '</td>';
                            $footer2 .= '<td style="' . WebSiteViewController::getStyle($colors_counter) . '">' . $k . '</td>';
                        @endphp
                    @endforeach
                </th>
                @php $colors_counter++ @endphp
            @endforeach

            @php
                $layan .= '</tr>';
                echo $layan;
            @endphp
    </thead>



    @php
        $ljnaId = -1;
        $colors_counter = 0;
    @endphp
    @foreach ($data->sortBy('ljna')->groupBy(['bngeh', 'ljna']) as $key => $value)
        <tr>
            @php
                $obj = $value->first()->first();
                if ($colors_counter == 0 || $colors_counter == 1) {
                    $colors_counter = $obj->lijna->numberOfBengasBelongToLjna();
                }
            @endphp
            <td style="{{ WebSiteViewController::getStyle($colors_counter) }}">
                {{ $key }}
            </td>

            @if ($ljnaId != $obj->lijna_id)
                @php
                    $ljnaId = $obj->lijna_id;
                @endphp
                <td rowspan="{{ $obj->lijna->numberOfBengasBelongToLjna() }}"
                    style="{{ WebSiteViewController::getStyle($colors_counter) }}">
                    {{ $obj->ljna }}
                </td>

            @endif

            <td style="{{ WebSiteViewController::getStyle(5) }}">
                {{ $obj->bingeh->jimara_dengderan }}
            </td>

            <td style="{{ WebSiteViewController::getStyle(6) }}">
                {{ $total = $data->where('bingeh_id', $obj->bingeh_id)->sum('jimara_dengan') }}</td>
            <td style="{{ WebSiteViewController::getStyle(7) }}">
                {{ $pochal =
    $data->where('jimara_kandidi_id', 1)->where('bingeh_id', $obj->bingeh_id)->first()->jimara_dengan ?? 0 }}
            </td>
            <td style="{{ WebSiteViewController::getStyle(8) }}">{{ $total - $pochal }}</td>
            @foreach ($kandids as $key => $kId)
                <td style="{{ WebSiteViewController::getStyle($kandids_colors[$key]) }}">
                    {{ $data->where('jimara_kandidi_id', $kId)->where('bingeh_id', $obj->bingeh_id)->first()->jimara_dengan ?? 0 }}
                </td>

            @endforeach
        </tr>
        @php $colors_counter-- @endphp
    @endforeach

    @php
        $footer .= '</tr>';
        $footer2 .= '</tr>';
    @endphp
    @php
        
        echo $footer;
        echo $footer2;
        
    @endphp

    <tbody>

    </tbody>
</table>
