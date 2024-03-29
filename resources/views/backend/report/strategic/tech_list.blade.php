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
                            <li class="breadcrumb-item"><a href="strategic-index">Strategic R&D</a></li>
                            <li class="breadcrumb-item active">Technologies/Information Generated</li>
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
                                <h2 class="card-title">List of Technologies/Information Generated from R&D</h2>
                                <div class="card-tools">
                                    <a href="{{ url('add-strategic-tech-list-index') }}"
                                        class="btn btn-success {{ Route::current()->getName() == 'add-programs-index' ? 'active' : '' }}"><span><i
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
                                                        <th>Type</th>
                                                        <th>Title</th>
                                                        <th>Agency</th>
                                                        <th>Researchers</th>
                                                        <th>Impact</th>
                                                        <th>Duration</th>
                                                        <th>Images</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($all as $key => $row)
                                                            @php
                                                                $res = json_decode($row->tech_researchers);
                                                                $res = implode(', ', $res);

                                                                $imgs = DB::table('strat_tech_list_imgs')
                                                                    ->where('strategic_tech_id', $row->id)
                                                                    ->inRandomOrder() // Fetch rows in random order
                                                                    ->limit(4)
                                                                    ->get();
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $row->tech_type }}</td>
                                                                <td>{{ strtoupper($row->tech_title) }}</td>
                                                                <td>{{ $row->tech_agency }}</td>
                                                                <td>

                                                                    {{ $res }}
                                                                </td>
                                                                <td>{{ $row->tech_impact }}</td>
                                                                <td>{{ $row->tech_duration }}</td>
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
                                                                                            style="width: 300px; height: 50px;"
                                                                                            class="img-thumbnail">
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-strategic-tech-list-index/' . Crypt::encryptString($row->id)) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-strategic-tech-list/' . Crypt::encryptString($row->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                        @foreach ($all_filter as $key => $row)
                                                            <tr>
                                                                <td>{{ $row->tech_type }}</td>
                                                                <td>{{ strtoupper($row->tech_title) }}</td>
                                                                <td>{{ $row->tech_agency }}</td>
                                                                <td>
                                                                    @php
                                                                        $res = json_decode($row->tech_researchers);
                                                                        $res = implode(', ', $res);
                                                                    @endphp
                                                                    {{ $res }}
                                                                </td>
                                                                <td>{{ $row->tech_impact }}</td>
                                                                <td>{{ $row->tech_duration }}</td>

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
                                                                                            style="width: 300px; height: 50px;"
                                                                                            class="img-thumbnail">
                                                                                    </a>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-strategic-tech-list-index/' . Crypt::encryptString($row->id)) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-strategic-tech-list/' . Crypt::encryptString($row->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
                                            <a href="{{ url('strategic-index') }}" class="btn btn-default">Back</a>
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
