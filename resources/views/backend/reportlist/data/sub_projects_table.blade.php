@if ($sp_records->isEmpty())
    <tr class="td-filtered">
        <td colspan="10">No data available</td>
    </tr>
@else
    @foreach ($sp_records as $row)
        <tr class="td-filtered">
            @php
                $project = DB::table('projects')
                    ->select('project_title')
                    ->where('id', '=', $row->projectID)
                    ->first(); // Execute the query to fetch the result
            @endphp
            <td>
                @if (!empty($row->sub_project_fund_code))
                    {{ $row->sub_project_fund_code }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                @if ($project)
                    {{ strtoupper($project->project_title) }}
                @else
                    {{ 'N/A' }}
                @endif
            </td>
            <td>
                {{ strtoupper($row->sub_project_title) }}
            </td>
            <td>
                @php
                    $leader = App\Models\Researchers::find($row->sub_project_leader);
                @endphp
                {{ $leader->first_name . ' ' . $leader->last_name }}
            </td>
            <td>
                {{ $row->sub_project_duration }}
            </td>
            @php
                if (!empty($row->sub_project_implementing_agency)) {
                    $imp = json_decode($row->sub_project_implementing_agency);
                    $imp = implode(', ', $imp);
                }

                if ($row->sub_project_collaborating_agency == 'null') {
                    $collab = 'N/A';
                } else {
                    $collab = json_decode($row->sub_project_collaborating_agency);
                    $collab = implode(', ', $collab);
                }

                if (!empty($row->sub_project_agency)) {
                    $funding = json_decode($row->sub_project_agency);
                    $funding = implode(', ', $funding);
                }

                $rc = $row->sub_project_research_center;
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
            <td>{{ $row->sub_project_description }}
            </td>
            <td>
                @if ($row->sub_project_status == 'New')
                    {{ $row->sub_project_status }}
                    <i class="fa-regular fa-square-plus" style="color: #0dcaf0;"></i>
                @elseif ($row->sub_project_status == 'Ongoing')
                    {{ $row->sub_project_status }}
                    <i class="fa-solid fa-spinner fa-spin" style="color: #0d6efd"></i>
                @elseif ($row->sub_project_status == 'Terminated')
                    {{ $row->sub_project_status }}
                    <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                @elseif ($row->sub_project_status == 'Completed')
                    {{ $row->sub_project_status }}
                    <i class="fa-regular fa-circle-check" style="color: #28a745;"></i>
                @endif
            </td>
        </tr>
    @endforeach
@endif
