<table class="table">
                <thead>
                    <tr>
                        <th style="background-color: #CCCCFD; width: 150px; height: 30px;text-align: center; border:4px solid #000000;">
                        سه‌رجه‌مێ گشتى یێ ده‌نگدرا
                        </th>
                        @foreach($lijnas as $lijna)
                            <th style="background-color: #CCCCFD; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">{{$lijna->jimara_dengderan}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        <th style="background-color: #4F81BD; width: 35px; height: 30px;text-align: center; border:4px solid #ffffff;">
                            ده م
                        </th>
                    @foreach($lijnas as $lijna)
                        <th style="background-color: #4F81BD; width: 15px; height: 30px;text-align: center; border:4px solid #ffffff;">{{$lijna->name}}</th>
                    @endforeach
                    <tr>
                </thead>
                <tbody>
                    @foreach($data->groupBy('time_id') as $key => $item)
                        <tr>
                            <td style="background-color: #FDFDFD; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                                <!-- {{$key}} -->
                                {{$times->where('id',$key)->first()->time}}
                            </td>
            
                        @foreach($lijnas as $lijna)
                            @if($key%2)
                            <td style="background-color: #DCE6F1; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            @else
                            <td style="background-color: #FBFBFB; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            @endif
                                {{$item->where('lijna_id', $lijna->id)->first()->jimara_beshdarboyan ?? 0}}
                            </td>
                        @endforeach
                        </tr>
                    @endforeach
                        <tr>
                            <td style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
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
                            <td style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                                {{$sum_array[$lijna->id] = $data->where('lijna_id', $lijna->id)->sum('jimara_beshdarboyan')}}
                            </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td style="background-color: #CCCCFD; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            رێژا ده‌نگدارا یێ به‌شدار
                            </td>
                            @foreach($lijnas as $key => $lijna)
                            <td style="background-color: #CCCCFD; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
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
                        <td style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            {{ $sum_lijna_jimara_dengderan }}
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2" style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                        سه‌رجه‌مێ گشتى یێن ده‌نگده‌ریێن به‌شداربوین
                        </td>
                        <td style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            {{ $sum_dengan }}
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2" style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                        رێژا گشتى یێن ده‌نگده‌ریێ به‌شداربوین
                        </td>
                        <td style="background-color: #FDF734; width: 15px; height: 30px;text-align: center; border:4px solid #000000;">
                            {{ round($sum_dengan/$sum_lijna_jimara_dengderan *100, 2) }}%
                        </td>

                    </tr>
                </tfoot>
            </table>