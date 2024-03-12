@if ($trainings->isEmpty())
    <tr class="td-filtered">
        <td colspan="6">No data available
        </td>
    </tr>
@else
    @foreach ($trainings as $item)
        @php
            $sof = json_decode($item->trainings_sof);
            $sof = implode(', ', $sof);

            $participants = DB::table('training_participants')
                ->select('type_of_participants', 'no_of_participants')
                ->where('training_id', '=', $item->id)
                ->get();
        @endphp
        <tr class="td-filtered">
            <td>{{ $item->trainings_title }}</td>
            <td>{{ $item->trainings_start }}</td>
            <td>{{ $item->trainings_venue }}</td>
            <td>
                @foreach ($participants as $participant)
                    <li>{{ $participant->type_of_participants }}
                        ({{ $participant->no_of_participants }})
                    </li>
                @endforeach
            </td>
            <td>₱{{ number_format($item->trainings_expenditures, 2) }}</td>
            <td>{{ $sof }}
        </tr>
    @endforeach
@endif
