@if ($issues->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($issues as $item)
        <tr class="td-filtered">
            <td>{{ $item->prc_title }}</td>
            <td>{{ $item->prc_agency }}</td>
            <td>{{ $item->prc_author }}</td>
            <td>{{ $item->prc_issues }}</td>
        </tr>
    @endforeach
@endif
