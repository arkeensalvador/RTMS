<tr class="td-filtered">
    <td colspan="4" style="background: #d3ffd1; color: black; text-align: center;" class="font-weight-bold">
        DEVELOPED/NEW
    </td>
</tr>
@if ($linkages_developed->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($linkages_developed as $ld)
        <tr class="td-filtered">
            <td>{{ $ld->form_of_development }}</td>
            <td>{{ $ld->address }}</td>
            <td>{{ $ld->year }}</td>
            <td>{{ $ld->nature_of_assistance }}</td>
        </tr>
    @endforeach
@endif

<tr class="td-filtered">
    <td colspan="4" style="background: #d3ffd1; color: black; text-align: center;" class="font-weight-bold">
        MAINTAINED/SUSTAINED
    </td>
</tr>
@if ($linkages_maintained->isEmpty())
    <tr class="td-filtered">
        <td colspan="4">No data available</td>
    </tr>
@else
    @foreach ($linkages_maintained as $lm)
        <tr class="td-filtered">
            <td>{{ $lm->form_of_development }}</td>
            <td>{{ $lm->address }}</td>
            <td>{{ $lm->year }}</td>
            <td>{{ $lm->nature_of_assistance }}</td>
        </tr>
    @endforeach
@endif
