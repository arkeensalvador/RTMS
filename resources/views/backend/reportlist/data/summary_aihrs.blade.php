@if (empty($fundedCounts) ||
        collect($fundedCounts)->every(fn($counts) => $counts['new'] == 0 &&
                $counts['ongoing'] == 0 &&
                $counts['terminated'] == 0 &&
                $counts['completed'] == 0 &&
                $counts['totalCount'] == 0))
    <tr class="td-filtered">
        <td colspan="6">No data available</td>
    </tr>
@else
    @foreach ($fundedCounts as $abbrev => $counts)
        @if (
            $counts['new'] > 0 ||
                $counts['ongoing'] > 0 ||
                $counts['terminated'] > 0 ||
                $counts['completed'] > 0 ||
                $counts['totalCount'] > 0)
            <tr class="td-filtered">
                <td>{{ $abbrev }}</td>
                <td>{{ $counts['new'] }}</td>
                <td>{{ $counts['ongoing'] }}</td>
                <td>{{ $counts['terminated'] }}</td>
                <td>{{ $counts['completed'] }}</td>
                <td>{{ $counts['totalCount'] }}</td>
            </tr>
        @endif
    @endforeach
@endif
