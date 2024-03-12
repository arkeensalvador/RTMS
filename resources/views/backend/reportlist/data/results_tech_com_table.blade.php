@if ($tech_commercialized->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available
        </td>
    </tr>
@else
    @foreach ($tech_commercialized as $item)
        <tr class="td-filtered">
            <td>{{ $item->ttm_type }}</td>
            <td>{{ $item->ttm_title }}</td>
            <td>{{ $item->ttm_agency }}</td>
            <td>{{ ucwords($item->ttm_status) }}</td>
        </tr>
    @endforeach
@endif
