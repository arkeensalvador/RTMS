@if ($p_records->isEmpty())
    <tr class="td-filtered">
        <td colspan="11">No data available</td>
    </tr>
@else
    @foreach ($p_records as $row)
        <tr class="td-filtered">
            @php
                $program = DB::table('programs')
                    ->select('program_title')
                    ->where('programID', '=', $row->programID)
                    ->first(); // Execute the query to fetch the result
            @endphp
            <td>
                @if (!empty($row->project_fund_code))
                    {{ $row->project_fund_code }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                @if ($program)
                    {{ strtoupper($program->program_title) }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                {{ strtoupper($row->project_title) }}
            </td>

            <td>
                @php
                    $leader = App\Models\Researchers::find($row->project_leader);
                @endphp
                {{ $leader->first_name . ' ' . $leader->last_name }}
            </td>
            <td>
                {{ $row->project_duration }}
            </td>
            @php
                if (!empty($row->project_implementing_agency)) {
                    $imp = json_decode($row->project_implementing_agency);
                    $imp = implode(', ', $imp);
                }

                if ($row->project_collaborating_agency == 'null') {
                    $collab = 'N/A';
                } else {
                    $collab = json_decode($row->project_collaborating_agency);
                    $collab = implode(', ', $collab);
                }

                if (!empty($row->project_agency)) {
                    $funding = json_decode($row->project_agency);
                    $funding = implode(', ', $funding);
                }
                $rc = $row->project_research_center;

                // Check if $rc is [null]
                if ($rc === '[null]') {
                    $rc = 'N/A';
                } else {
                    // If $rc is not [null], perform the replacements
                    $rc = str_replace(['[', '"', ']'], '', $rc);
                    $rc = str_replace(',', ', ', $rc);
                }
            @endphp

            <td>{{ $funding }}</td>

            <td>{{ $imp }} </td>
            <td>{{ $collab }}</td>
            <td>{{ $rc }}</td>

            <td>{{ $row->project_description }}
            </td>
            <td>
                @if ($row->project_status == 'New')
                    {{ $row->project_status }}
                    <i class="fa-regular fa-square-plus" style="color: #0dcaf0;"></i>
                @elseif ($row->project_status == 'Ongoing')
                    {{ $row->project_status }}
                    <i class="fa-solid fa-spinner fa-spin" style="color: #0d6efd"></i>
                @elseif ($row->project_status == 'Terminated')
                    {{ $row->project_status }}
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                @elseif ($row->project_status == 'Completed')
                    {{ $row->project_status }}
                    <i class="fa-regular fa-circle-check" style="color: #28a745;"></i>
                @endif
            </td>
        </tr>
    @endforeach
@endif
