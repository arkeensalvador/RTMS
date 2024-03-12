@if ($contributions->isEmpty())
    <tr class="td-filtered">
        <td colspan="2">No data available</td>
    </tr>
@else
    @foreach ($contributions as $item)
        <tr class="td-filtered">
            <td>{{ $item->con_name }}</td>
            <td>₱{{ number_format($item->con_amount, 2) }}</td>
        </tr>
    @endforeach
@endif
