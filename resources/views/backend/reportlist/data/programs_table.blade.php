@if ($records->isEmpty())
    <tr class="td-filtered">
        <td colspan="10">No data available</td>
    </tr>
@else
    @foreach ($records as $key => $row)
        <tr class="td-filtered">
            @php
                if (!empty($row->implementing_agency)) {
                    $imp = json_decode($row->implementing_agency);
                    $imp = implode(', ', $imp);
                }

                if ($row->collaborating_agency == 'null') {
                    $collab = 'N/A';
                } else {
                    $collab = json_decode($row->collaborating_agency);
                    $collab = implode(', ', $collab);
                }

                if (!empty($row->funding_agency)) {
                    $funding = json_decode($row->funding_agency);
                    $funding = implode(', ', $funding);
                }

                $rc = $row->research_center;
                // Check if $rc is [null]
                if ($rc === '[null]') {
                    $rc = 'N/A';
                } else {
                    // If $rc is not [null], perform the replacements
                    $rc = str_replace(['[', '"', ']'], '', $rc);
                    $rc = str_replace(',', ', ', $rc);
                }
            @endphp
            <td>
                @if (!empty($row->fund_code))
                    {{ $row->fund_code }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                {{ strtoupper($row->program_title) }}
            </td>
            <td>
                @php
                    $leader = App\Models\Researchers::find($row->program_leader);
                @endphp
                {{ $leader->first_name . ' ' . $leader->last_name }}
            </td>
            <td>
                {{ $row->duration }}
            </td>
            <td>{{ $funding }}</td>

            <td>{{ $imp }} </td>
            <td>{{ $collab }}</td>
            <td>{{ $rc }}</td>
            <td>
                {{ $row->program_description }}
            </td>
            <td>
                {{ $row->program_status }}
            </td>
        </tr>
    @endforeach
@endif
