@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row pt-2 ">
                            <div class="col-md-6 ">
                                <div class="card-counter bg-primary text-white">
                                    <i class="fa fa-area-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        {{ number_format($sub_projects->sub_project_amount_released, 2) }}
                                    </span>
                                    <span class="card-title font-italic">Released Budget</span>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card-counter bg-success text-white">
                                    <i class="fa fa-calendar-o"></i>
                                    <span class="count-duration h2">
                                        @php
                                            use Carbon\Carbon;
                                            // Get the date range from the flatpickr input
                                            $dateRange = $sub_projects->sub_project_duration;

                                            // Extract start and end dates from the range
                                            [$startDate, $endDate] = explode(' to ', $dateRange);

                                            // Convert the string dates to Carbon objects
                                            $startDate = Carbon::createFromFormat('m/d/Y', $startDate);
                                            $endDate = Carbon::createFromFormat('m/d/Y', $endDate);

                                            // Calculate the difference in months
                                            $months = $startDate->diffInMonths($endDate);
                                        @endphp
                                        {{ $sub_projects->sub_project_duration }}
                                    </span>
                                    <span class="card-title font-italic">Duration</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <h2 class="font-weight-bold text-center">{{ $sub_projects->sub_project_title }}</h2>
                            <div class="h_line"></div>
                            <p class="font-italic text-center my-3 px-5">
                                {{ $sub_projects->sub_project_description }}
                            </p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="thwidth">Duration</th>
                                        <td>{{ $months }} Months</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project/Study Leader</th>
                                        <td>{{ $sub_project_leader->first_name . ' ' . $sub_project_leader->middle_name . ' ' . $sub_project_leader->last_name }}
                                        </td>
                                    </tr>
                                    @php
                                        $funding = json_decode($sub_projects->sub_project_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Funding Agency</th>
                                        <td>{{ implode(', ', $funding) }}</td>
                                    </tr>
                                    @php
                                        $imp = json_decode($sub_projects->sub_project_implementing_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Implementing Agency</th>
                                        <td>{{ implode(' / ', $imp) }}</td>
                                    </tr>
                                    @php
                                        if ($sub_projects->sub_project_collaborating_agency == 'null') {
                                            $collab = 'N/A';
                                        } else {
                                            $collab = json_decode($sub_projects->sub_project_collaborating_agency);
                                            $collab = implode(', ', $collab);
                                        }
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Collaborating Agency</th>
                                        <td>{{ $collab }}</td>
                                    </tr>

                                    @php
                                        if ($sub_projects->sub_project_research_center == '[null]') {
                                            $rc = 'N/A';
                                        } else {
                                            $rc = json_decode($sub_projects->sub_project_research_center);
                                            $rc = implode(', ', $rc);
                                        }
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">R & D Center(s)</th>
                                        <td>{{ $rc }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Staff(s)</th>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($personnels as $personnel => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('delete-staff/' . $items->id) }}"
                                                            class="btn btn-danger float-right" id="delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        {{ $items->staff_name }}
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Files</th>

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
                                        <th scope="row" class="thwidth">Type of funding grant</th>
                                        <td>
                                            {{ $sub_projects->sub_project_funding_grant }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <table id="budget-table" class="table">
                                <thead>
                                    <tr>
                                        <th>Proposed Budget Breakdown</th>
                                        <th>Year No.</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budgetData as $key => $data)
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control budget-input"
                                                    name="approved_budget[]" readonly oninput="validateInput(this)"
                                                    value="{{ number_format($data->approved_budget) }}" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control year-input" name="budget_year[]"
                                                    value="{{ $data->budget_year }}" required readonly>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div id="total-budget">Total Proposed Budget: <span class="font-weight-bold">₱ </span><span
                                    id="total">{{ number_format($sub_projects->sub_project_amount_released, 2) }}</span>
                            </div>

                            <div class="text-center mt-5 mb-3">
                                <a href="{{ url('sub-projects-view/' . $sub_projects->projectID) }}"
                                    class="btn btn previous btn btn-default">Go back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
