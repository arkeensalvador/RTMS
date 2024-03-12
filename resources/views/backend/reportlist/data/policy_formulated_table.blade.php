@if ($formulated->isEmpty())
    <tr class="td-filtered">
        <td colspan="8">No data available</td>
    </tr>
@else
    @foreach ($formulated as $item)
        <tr class="td-filtered">
            <td>{{ $item->policy_type }}</td>
            <td>{{ $item->policy_title }}</td>
            <td>{{ $item->policy_agency }}</td>
            <td>{{ $item->policy_author }}</td>
            <td>{{ $item->policy_co_author }}</td>
            <td>{{ $item->policy_beneficiary }}</td>
            <td>{{ $item->policy_implementer }}</td>
            <td>{{ $item->policy_issues }}</td>
        </tr>
    @endforeach
@endif
