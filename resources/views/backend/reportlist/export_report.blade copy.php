<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 5px;
            padding-bottom: 5px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>

<body>

    <h3>List of Programs</h3>

    <table id="customers">
        <tr>
            <th>Program Title</th>
            <th>Description</th>
            <th>Duration(m/d/Y)</th>
            <th>Funding Agency</th>
        </tr>
        @foreach ($list as $data)
            <tr>
                <td>{{ $data->program_title }}</td>
                <td>{{ $data->program_description }}</td>
                <td>
                    {{ date('m/d/Y', strtotime($data->start_date)) ?: 'Not Set' }} -
                    {{ date('m/d/Y', strtotime($data->end_date)) ?: 'Not Set' }}
                </td>
                <td>{{ $data->funding_agency }}</td>
            </tr>
        @endforeach
    </table>

    <h3>List of Projects</h3>
    <table id="customers">
        <tr>
            <th>Project Title</th>
            <th>Description</th>
            <th>Duration(m/d/Y)</th>
            <th>Funding Agency</th>
        </tr>
        @foreach ($plist as $pl)
            <tr>
                <td>{{ $pl->project_title }}</td>
                <td>{{ $pl->project_description }}</td>
                <td>
                    {{ date('m/d/Y', strtotime($pl->project_start_date)) ?: 'Not Set' }} -
                    {{ date('m/d/Y', strtotime($pl->project_end_date)) ?: 'Not Set' }}
                </td>
                <td>{{ $pl->project_agency }}</td>
            </tr>
        @endforeach
    </table>

    <h3>List of Sub-Projects</h3>
    <table id="customers">
        <tr>
            <th>Sub-Project Title</th>
            <th>Description</th>
            <th>Duration(m/d/Y)</th>
            <th>Funding Agency</th>
        </tr>
        @foreach ($splist as $spl)
            <tr>
                <td>{{ $spl->sub_project_title }}</td>
                <td>{{ $spl->sub_project_description }}</td>
                <td>
                    {{ date('m/d/Y', strtotime($spl->sub_project_start_date)) ?: 'Not Set' }} -
                    {{ date('m/d/Y', strtotime($spl->sub_project_end_date)) ?: 'Not Set' }}
                </td>
                <td>{{ $spl->sub_project_agency }}</td>
            </tr>
        @endforeach
    </table>

    {{-- <h3>List of Sub-Projects</h3>
    <table id="customers">
        <tr>
            <th>Sub-Project Title</th>
            <th>Description</th>
            <th>Duration(m/d/Y)</th>
            <th>Funding Agency</th>
        </tr>
        @foreach ($splist as $spl)
            <tr>
                <td>{{ $spl->sub_project_title }}</td>
                <td>{{ $spl->sub_project_description }}</td>
                <td>
                    {{ date('m/d/Y', strtotime($spl->sub_project_start_date)) ?: 'Not Set' }} -
                    {{ date('m/d/Y', strtotime($spl->sub_project_end_date)) ?: 'Not Set' }}
                </td>
                <td>{{ $spl->sub_project_agency }}</td>
            </tr>
        @endforeach
    </table> --}}



</body>
{{-- <script>
    $(function() {
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });
    });
</script> --}}

</html>
