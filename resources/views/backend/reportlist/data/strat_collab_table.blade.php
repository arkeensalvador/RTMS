@if ($strat_collaborative->isEmpty())
    <tr class="td-filtered">
        <td colspan="8">No data available</td>
    </tr>
@else
    @foreach ($strat_collaborative as $item)
        @php
            if (!empty($item->str_collab_imp_agency)) {
                $imp = json_decode($item->str_collab_imp_agency);
                $imp = implode(', ', $imp);
            }

            if (!empty($item->str_collab_agency)) {
                $collab = json_decode($item->str_collab_agency);
                $collab = implode(', ', $collab);
            }

            if (!empty($item->str_collab_sof)) {
                $sof = json_decode($item->str_collab_sof);
                $sof = implode(', ', $sof);
            }

            [$startDateString, $endDateString] = explode(' to ', $item->str_collab_date);
            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDateString));
            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDateString));
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->str_collab_program }}</td>
            <td>{{ $item->str_collab_project }}</td>
            <td>
                {{ $imp }}
            </td>
            <td>
                {{ $collab }}
            </td>
            <td>
                @if ($startDate === $endDate)
                    {{ $startDate }}
                @else
                    {{ $startDate->format('F Y') }} to
                    {{ $endDate->format('F Y') }}
                @endif
            </td>
            <td>₱{{ number_format($item->str_collab_budget, 2) }}</td>
            <td>{{ $sof }}</td>
            <td>{{ $item->str_collab_roc }}</td>
        </tr>
    @endforeach
@endif
