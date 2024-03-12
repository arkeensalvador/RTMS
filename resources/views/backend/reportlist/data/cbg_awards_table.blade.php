@if ($awards->isEmpty())
    <tr class="td-filtered">
        <td colspan="7">No data available</td>
    </tr>
@else
    @foreach ($awards as $item)
        <tr class="td-filtered">
            <td>{{ $item->awards_type }}</td>
            <td>{{ $item->awards_title }}</td>
            <td>{{ $item->awards_recipients . '/' . $item->awards_agency }}</td>
            <td>{{ $item->awards_sponsor }}</td>
            <td>{{ $item->awards_event }}</td>
            <td>{{ $item->awards_place }}</td>
            <td>{{ date('F d, Y', strtotime($item->awards_date)) }}</td>
        </tr>
    @endforeach
@endif
