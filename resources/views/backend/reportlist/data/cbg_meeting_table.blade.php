@if ($meetings->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($meetings as $item)
        <tr class="td-filtered">
            <td>{{ $item->meeting_type }}</td>
            <td>{{ $item->meeting_venue }}</td>
            <td>{{ date('F d, Y', strtotime($item->meeting_date)) }}</td>
            <td>{{ $item->meeting_host }}</td>
        </tr>
    @endforeach
@endif
