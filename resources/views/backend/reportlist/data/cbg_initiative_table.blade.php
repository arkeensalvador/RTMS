@if ($initiatives->isEmpty())
    <tr class="td-filtered">
        <td colspan="2">No data available</td>
    </tr>
@else
    @foreach ($initiatives as $item)
        <tr class="td-filtered">
            <td>{{ $item->ini_initiates }}</td>
            <td>{{ date('F d, Y', strtotime($item->ini_date)) }}</td>
        </tr>
    @endforeach
@endif
