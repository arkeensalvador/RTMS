<tr class="td-filtered">
    <td colspan="4" style="background: #d3ffd1; color: black; text-align: center;" class="font-weight-bold">
        DATABASE DEVELOPED/ENHANCED AND MAINTAINED
    </td>
</tr>
@if ($db->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($db as $record)
        <tr class="td-filtered">
            <td>{{ $record->dbinfosys_title }}</td>
            <td>{{ $record->dbinfosys_type }}</td>
            <td>{{ date('m/d/Y', strtotime($record->dbinfosys_date_created)) }}</td>
            <td>{{ $record->dbinfosys_purpose }}</td>
        </tr>
    @endforeach
@endif

<tr class="td-filtered">
    <td colspan="4" style="background: #d3ffd1; color: black; text-align: center;" class="font-weight-bold">
        INFORMATION SYSTEM DEVELOPED/ENHANCED AND MAINTAINED
    </td>
</tr>
@if ($is->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($is as $record)
        <tr class="td-filtered">
            <td>{{ $record->dbinfosys_title }}</td>
            <td>{{ $record->dbinfosys_type }}</td>
            <td>{{ date('m/d/Y', strtotime($record->dbinfosys_date_created)) }}</td>
            <td>{{ $record->dbinfosys_purpose }}</td>
        </tr>
    @endforeach
@endif
