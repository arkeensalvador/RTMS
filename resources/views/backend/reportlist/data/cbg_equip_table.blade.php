@if ($equipments->isEmpty())
    <tr class="td-filtered">
        <td colspan="5">No data available
        </td>
    </tr>
@else
    @foreach ($equipments as $item)
        @php
            $sof = json_decode($item->equipments_sof);
            $sof = implode(', ', $sof);
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->equipments_type }}</td>
            <td>{{ $item->equipments_name }}</td>
            <td>{{ $item->equipments_agency }}</td>
            <td>₱{{ number_format($item->equipments_total, 2) }}</td>
            <td>{{ $sof }}</td>
        </tr>
    @endforeach
@endif
