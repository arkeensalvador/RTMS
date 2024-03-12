<tr class="td-filtered">
    <td colspan="6" style="background: #ddffff; color: black; text-align:center;" class="font-weight-bold">RESEARCH</td>
</tr>
@if ($strat_tech_research->isEmpty())
    <tr class="td-filtered">
        <td colspan="6">No data available
        </td>
    </tr>
@else
    @foreach ($strat_tech_research as $item)
        @php
            $res = json_decode($item->tech_researchers);
            $res = implode(', ', $res);
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->tech_title }}</td>
            <td>{{ $item->tech_agency }}</td>
            <td>{{ $res }}</td>
            <td>{{ $item->tech_duration }}</td>
            <td>{{ $item->tech_impact }}</td>
        </tr>
    @endforeach
@endif


<tr class="td-filtered">
    <td colspan="6" style="background: #ddffff; color: black; text-align: center;" class="font-weight-bold">
        DEVELOPMENT
    </td>
</tr>
@if ($strat_tech_dev->isEmpty())
    <tr class="td-filtered">
        <td colspan="6">No data available
        </td>
    </tr>
@else
    @foreach ($strat_tech_dev as $item)
        @php
            $res = json_decode($item->tech_researchers);
            $res = implode(', ', $res);
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->tech_title }}</td>
            <td>{{ $item->tech_agency }}</td>
            <td>{{ $res }}</td>
            <td>{{ $item->tech_duration }}</td>
            <td>{{ $item->tech_impact }}</td>
        </tr>
    @endforeach
@endif
