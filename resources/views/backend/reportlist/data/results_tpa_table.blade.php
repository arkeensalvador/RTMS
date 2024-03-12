@if ($tpa->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available
        </td>
    </tr>
@else
    @foreach ($tpa as $item)
        @php
            $approaches = json_decode($item->tpa_approaches);
            $approaches = implode(', ', $approaches);
        @endphp
        <tr class="td-filtered">
            <td>{{ $approaches }}</td>
            <td>{{ $item->tpa_title }}</td>
            <td>{{ $item->tpa_agency }}</td>
            <td>{{ $item->tpa_details }}</td>
        </tr>
    @endforeach
@endif
