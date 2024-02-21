<tr class="td-filtered">
    <td colspan="7" style="text-align: center; font-size: 14px;" class="font-weight-bold">
        PROPOSALS PACKAGED</td>
</tr>
@if ($ttp_proposal->isEmpty())
    <tr class="td-filtered">
        <td colspan="7">No data available</td>
    </tr>
@else
    @foreach ($ttp_proposal as $item)
        @php
            $prop = json_decode($item->ttp_proponent);
            $prop = implode(', ', $prop);

            $rs = json_decode($item->ttp_researchers);
            $rs = implode(', ', $rs);

            $imp = json_decode($item->ttp_implementing_agency);
            $imp = implode(', ', $imp);

            $sof = json_decode($item->ttp_sof);
            $sof = implode(', ', $sof);
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->ttp_title }}</td>
            <td>{{ $prop . ' / ' . $rs }}</td>
            <td>{{ $imp }}</td>
            <td>{{ $item->ttp_date }}</td>
            <td>{{ $sof }}</td>
            <td>₱{{ number_format($item->ttp_budget, 2) }}</td>
            <td>{{ $item->ttp_priorities }}</td>
        </tr>
    @endforeach
@endif

<tr class="td-filtered">
    <td colspan="7" style="text-align: center; font-size: 14px;" class="font-weight-bold">PROJECTS APPROVED AND
        IMPLEMENTED
    </td>
</tr>
@if ($ttp_approved->isEmpty())
    <tr class="td-filtered">
        <td colspan="7">No data available</td>
    </tr>
@else
    @foreach ($ttp_approved as $item)
        @php
            $prop = json_decode($item->ttp_proponent);
            $prop = implode(', ', $prop);

            $rs = json_decode($item->ttp_researchers);
            $rs = implode(', ', $rs);

            $imp = json_decode($item->ttp_implementing_agency);
            $imp = implode(', ', $imp);

            $sof = json_decode($item->ttp_sof);
            $sof = implode(', ', $sof);
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->ttp_title }}</td>
            <td>{{ $prop . ' / ' . $rs }}</td>
            <td>{{ $imp }}</td>
            <td>{{ $item->ttp_date }}</td>
            <td>{{ $sof }}</td>
            <td>₱{{ number_format($item->ttp_budget, 2) }}</td>
            <td>{{ $item->ttp_priorities }}</td>
        </tr>
    @endforeach
@endif
