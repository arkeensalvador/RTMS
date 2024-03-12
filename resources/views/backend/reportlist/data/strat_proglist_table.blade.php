<tr class="td-filtered">
    <td colspan="6" style="background: #ddffff; color: black; text-align: center;" class="font-weight-bold">PROPOSALS
        PACKAGED</td>
</tr>
@if ($stratProgramListProposal->isEmpty())
    <tr class="td-filtered">
        <td colspan="6">No data available</td>
    </tr>
@else
    @foreach ($stratProgramListProposal as $splp)
        <tr class="td-filtered">
            <td>{{ $splp->str_p_title }}</td>
            @php
                $imp = json_decode($splp->str_p_imp_agency);
                $imp = implode(', ', $imp);

                $sof = json_decode($splp->str_p_sof);
                $sof = implode(', ', $sof);
            @endphp
            <td>{{ $imp }}</td>
            <td>{{ $splp->str_p_date }}</td>
            <td>{{ $sof }}</td>
            <td>₱{{ number_format($splp->str_p_budget, 2) }}</td>
            <td>{{ $splp->str_p_regional }}</td>
        </tr>
    @endforeach
@endif

<tr class="td-filtered">
    <td colspan="6" style="background: #ddffff; color: black; text-align: center;" class="font-weight-bold">PROJECTS
        APPROVED AND
        IMPLEMENTED</td>
</tr>
@if ($stratProgramListApproved->isEmpty())
    <tr class="td-filtered">
        <td colspan="6">No data available</td>
    </tr>
@else
    @foreach ($stratProgramListApproved as $spla)
        <tr class="td-filtered">
            <td>{{ $spla->str_p_title }}</td>
            @php
                $imp = json_decode($spla->str_p_imp_agency);
                $imp = implode(', ', $imp);

                $sof = json_decode($spla->str_p_sof);
                $sof = implode(', ', $sof);
            @endphp
            <td>{{ $imp }}</td>
            <td>{{ $spla->str_p_date }}</td>
            <td>{{ $sof }}</td>
            <td>₱{{ number_format($spla->str_p_budget, 2) }}</td>
            <td>{{ $spla->str_p_regional }}</td>
        </tr>
    @endforeach
@endif
