@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row pt-2 ">
                            <div class="col-md-4 ">
                                <div class="card-counter bg-primary text-white">
                                    <i class="fa fa-area-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        @empty($program->amount_released)
                                            -
                                        @else
                                            {{ $program->amount_released }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic ">Program Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-info text-white">
                                    <i class="fa fa-bar-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        @empty($program->amount_released)
                                            -
                                        @else
                                            {{ $program->amount_released }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic">Approved Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-success text-white">
                                    <i class="fa fa-calendar-o"></i>
                                    <span class="count-duration h2">
                                        @php
                                            use Carbon\Carbon;
                                            // Get the date range from the flatpickr input
                                            $dateRange = $program->duration;

                                            // Extract start and end dates from the range
                                            [$startDate, $endDate] = explode(' to ', $dateRange);

                                            // Convert the string dates to Carbon objects
                                            $startDate = Carbon::createFromFormat('m/d/Y', $startDate);
                                            $endDate = Carbon::createFromFormat('m/d/Y', $endDate);

                                            // Calculate the difference in months
                                            $months = $startDate->diffInMonths($endDate);
                                        @endphp
                                        {{ $program->duration }}
                                    </span>
                                    <span class="card-title font-italic">Program Duration</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <h2 class="font-weight-bold text-center">{{ $program->program_title }}</h2>
                            <div class="h_line"></div>
                            <p class="font-italic text-center my-3 px-5">
                                {{ $program->program_description }}
                            </p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="thwidth">Program ID</th>
                                        <td>{{ $program->programID }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Duration</th>
                                        <td>{{ $months }} Months</td>
                                    </tr>
                                    @php
                                        $funding = json_decode($program->funding_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Funding Agency</th>
                                        <td>{{ implode(', ', $funding) }}</td>
                                    </tr>
                                    @php
                                        $imp = json_decode($program->implementing_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Implementing Agency</th>
                                        <td>{{ implode(' / ', $imp) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Program Leader</th>
                                        <td>{{ $program->program_leader }}</td>
                                    </tr>
                                    {{-- <tr>
                                        <th scope="row" class="thwidth">Program Assistant Leader</th>
                                        <td>{{ $program->assistant_leader }}</td>
                                    </tr> --}}
                                    <tr>
                                        <th scope="row" class="thwidth">Program Staff(s)</th>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($personnels as $personnel => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('delete-staff/' . $items->id) }}"
                                                            class="btn btn-danger float-right">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        {{ $items->staff_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Program Files</th>

                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($upload_files as $key => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('delete-file/' . $items->id) }}"
                                                            class="btn btn-danger float-right" id="delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="{{ url('download/' . $items->id) }}"
                                                            class="btn btn-info float-right">
                                                            <i class="fa-solid fa-download"></i>
                                                        </a>

                                                        {{ $items->file_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Project(s) under this program</th>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($projects as $key => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('view-project-index/' . $items->id) }}"
                                                            class="btn-link text-secondary" id="delete"><i
                                                                class="fa-solid fa-book mr-2"></i>{{ $items->project_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-center mt-5 mb-3">
                                <a href="{{ url('rdmc-programs') }}" class="btn btn previous btn btn-default">Go back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
