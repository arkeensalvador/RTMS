@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">{{ auth()->user()->role }} - Manage Accounts</h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item"><a href="report-index">Reports</a></li>
                            <li class="breadcrumb-item"><a href="cbg-index">CBG</a></li>
                            <li class="breadcrumb-item active">Trainings
                            </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">List of Trainings</h2>
                                <div class="card-tools">
                                    <a href="{{ url('cbg-training-add') }}" class="btn btn-success"><span><i
                                                class="fa-solid fa-plus"></i> Create</span></a>
                                    <!-- Here is a label for example -->
                                    {{-- <span class="badge badge-primary">Label</span> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Title</th>
                                                        <th style="width: 110px">No. of Participants</th>
                                                        <th>Venue</th>
                                                        <th>Expenditures</th>
                                                        <th>Source of Fund / R&D Center(s)</th>
                                                        <th>Implementing Agency</th>
                                                        <th>Duration</th>
                                                        <th>Remarks</th>
                                                        <th>Images</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($all as $key => $row)
                                                            @php
                                                                $rc = $row->trainings_research_center;
                                                                // Check if $rc is [null]
                                                                if ($rc === '[null]') {
                                                                    $rc = 'N/A';
                                                                } else {
                                                                    // If $rc is not [null], perform the replacements
                                                                    $rc = str_replace(['[', '"', ']'], '', $rc);
                                                                    $rc = str_replace(',', ', ', $rc);
                                                                }

                                                                $sof = json_decode($row->trainings_sof);
                                                                $sof = implode(', ', $sof);

                                                                $agency = json_decode($row->trainings_agency);
                                                                $agency = implode(', ', $agency);

                                                                $participants = DB::table('training_participants')
                                                                    ->select(
                                                                        'type_of_participants',
                                                                        'no_of_participants',
                                                                    )
                                                                    ->where('training_id', '=', $row->id)
                                                                    ->get();
                                                                $imgs = DB::table('trainings_imgs')
                                                                    ->where('training_id', $row->id)
                                                                    ->inRandomOrder() // Fetch rows in random order
                                                                    ->limit(4)
                                                                    ->get();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ strtoupper($row->trainings_title) }}</td>

                                                                <td>

                                                                    @foreach ($participants as $participant)
                                                                        <li>{{ $participant->type_of_participants }}
                                                                            ({{ $participant->no_of_participants }})
                                                                        </li>
                                                                    @endforeach

                                                                </td>
                                                                <td>{{ $row->trainings_venue }}</td>
                                                                <td>₱{{ number_format($row->trainings_expenditures, 2) }}
                                                                </td>
                                                                <td>{{ $sof }} / {{ $rc }}
                                                                </td>
                                                                <td>{{ $agency }}</td>
                                                                <td>{{ $row->trainings_start }}</td>

                                                                <td>
                                                                    {{ $row->trainings_remarks ?: 'N/A' }}
                                                                </td>
                                                                <td class="images">
                                                                    @if (empty($imgs))
                                                                        {{ 'No image available' }}
                                                                    @else
                                                                        <div
                                                                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                                                            @foreach ($imgs as $img)
                                                                                <div>
                                                                                    <a href="{{ asset($img->filename) }}"
                                                                                        data-lightbox="photos"
                                                                                        title="Click to view">
                                                                                        <img src="{{ asset($img->filename) }}"
                                                                                            alt=""
                                                                                            style="width: 200px; height: 50px;"
                                                                                            class="img-thumbnail">
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-training/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-training/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                        @foreach ($all_filter as $key => $row)
                                                            @php
                                                                $rc = $row->trainings_research_center;
                                                                // Check if $rc is [null]
                                                                if ($rc === 'null') {
                                                                    $rc = 'N/A';
                                                                } else {
                                                                    // If $rc is not [null], perform the replacements
                                                                    $rc = str_replace(['[', '"', ']'], '', $rc);
                                                                    $rc = str_replace(',', ', ', $rc);
                                                                }

                                                                $sof = json_decode($row->trainings_sof);
                                                                $sof = implode(', ', $sof);

                                                                $agency = json_decode($row->trainings_agency);
                                                                $agency = implode(', ', $agency);

                                                                $participants = DB::table('training_participants')
                                                                    ->select(
                                                                        'type_of_participants',
                                                                        'no_of_participants',
                                                                    )
                                                                    ->where('training_id', '=', $row->id)
                                                                    ->get();

                                                                $imgs = DB::table('trainings_imgs')
                                                                    ->where('training_id', $row->id)
                                                                    ->inRandomOrder() // Fetch rows in random order
                                                                    ->limit(4)
                                                                    ->get();

                                                            @endphp
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ strtoupper($row->trainings_title) }}</td>

                                                                <td>
                                                                    @foreach ($participants as $participant)
                                                                        <li>{{ $participant->type_of_participants }}
                                                                            ({{ $participant->no_of_participants }})
                                                                        </li>
                                                                    @endforeach
                                                                </td>
                                                                <td>{{ $row->trainings_venue }}</td>
                                                                <td>₱{{ number_format($row->trainings_expenditures, 2) }}
                                                                </td>
                                                                <td>{{ $sof }} / {{ $rc }}
                                                                </td>
                                                                <td>{{ $agency }}</td>
                                                                <td>{{ $row->trainings_start }}</td>

                                                                <td>
                                                                    {{ $row->trainings_remarks ?: 'N/A' }}
                                                                </td>
                                                                <td class="images">
                                                                    @if (empty($imgs))
                                                                        {{ 'No image available' }}
                                                                    @else
                                                                        <div
                                                                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                                                                            @foreach ($imgs as $img)
                                                                                <div>
                                                                                    <a href="{{ asset($img->filename) }}"
                                                                                        data-lightbox="photos">
                                                                                        <img src="{{ asset($img->filename) }}"
                                                                                            alt=""
                                                                                            style="width: 200px; height: 50px;"
                                                                                            class="img-thumbnail">
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-training/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-training/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
                                            <a href="{{ url('cbg-index') }}" class="btn btn-default">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
