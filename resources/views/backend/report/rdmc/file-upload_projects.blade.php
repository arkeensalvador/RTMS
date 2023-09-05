@extends('backend.layouts.app')
@section('content')
    <style>
        .radio-input input {
            display: none;
        }

        .radio-input {
            --container_width: 200px;
            position: relative;
            display: flex;
            height: 2.76rem;
            align-items: center;
            border-radius: 10px;
            background-color: #fff;
            color: #000000;
            width: var(--container_width);
            overflow: hidden;
            border: 1px solid rgba(53, 52, 52, 0.226);
        }


        .radio-input label.upl {
            width: 100%;
            padding: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            font-weight: 600;
            letter-spacing: 1.5px;
            font-size: 14px;
        }

        label.upl {
            margin: 0 auto;
        }

        span.sel {
            display: none;
            position: absolute;
            height: 100%;
            width: calc(var(--container_width) / 2);
            z-index: 0;
            left: 0;
            top: 0;
            transition: .15s ease;
        }

        input#file-upload1,
        input#file-upload2,
        input#file-upload3,
        input#file-upload4 {
            height: auto !important;
        }

        .radio-input label.upl:has(input:checked) {
            color: #fff;
            /* color: #28a745; */
        }

        .radio-input label.upl:has(input:checked)~.sel {
            /* background-color: rgb(11 117 223); */
            background-color: #17a2b8;
            display: inline-block;
        }

        .radio-input label.upl:nth-child(1):has(input:checked)~.sel {
            transform: translateX(calc(var(--container_width) * 0/2));
        }

        .radio-input label.upl:nth-child(2):has(input:checked)~.sel {
            transform: translateX(calc(var(--container_width) * 1/2));
        }
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="row files">
                <div class="col-lg-7">

                    {{-- card start --}}
                    <div class="strategic card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Upload Files
                            </h5>
                        </div>
                        {{-- card body start --}}
                        <div class="card-body">
                            <form action="{{ URL::to('/project-upload-file') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <input type="text" class="form-control" name="programID"
                                    value="{{ $project->programID }}" placeholder="Program ID"  readonly required
                                    autocomplete="false">

                                <input type="text" class="form-control" name="projectID" value="{{ $project->id }}"
                                    placeholder="Project ID"  readonly required autocomplete="false">

                                <input type="text" class="form-control" name="uploader_agency"
                                    value="{{ auth()->user()->agencyID }}" placeholder="Program ID" hidden readonly required
                                    autocomplete="false">

                                <input type="text" class="form-control" name="type" value="project" placeholder="Type"
                                    hidden readonly required autocomplete="false">

                                {{-- file input 1 --}}
                                <label for="">Memorandum of Agreement</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" disabled id="file-input1" name="file_moa">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="filecheck" onclick="enableCreateUser()">
                                        </div>
                                    </div>
                                </div>

                                {{-- file input 2 --}}
                                <label for="">Line Item Budget</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" disabled id="file-input2" name="file_lib">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="filecheck2" onclick="enableCreateUser()">
                                        </div>
                                    </div>
                                </div>

                                {{-- file input 3 --}}
                                <label for="">Notice to Proceed</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" disabled id="file-input3" name="file_ntp">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="filecheck3" onclick="enableCreateUser()">
                                        </div>
                                    </div>
                                </div>


                                {{-- file input 4 --}}
                                <label for="">Terminal Report</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" disabled id="file-input4" name="file_tr">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="filecheck4" onclick="enableCreateUser()">
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="custom-file">
                                    <input type="file" class="form-control" name="file" id="chooseFile" required>
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div> --}}
                                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                                    Upload File
                                </button>
                            </form>
                        </div> {{-- card body end --}}
                    </div>{{-- card end --}}

                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            {{-- <th>Path Name</th> --}}
                                            <th>File Name</th>
                                            <th>Date & Time Uploaded</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($upload_files as $key => $items)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                {{-- <td>{{ $items->path }}</td> --}}
                                                <td><a
                                                        href="{{ url('download/' . $items->id) }}">{{ $items->file_name }}</a>
                                                </td>
                                                <td>{{ $items->created_at }}</td>
                                                <td><a href="{{ URL::to('/delete-file/' . $items->id) }}"
                                                        class="btn btn-sm btn-danger" id="delete">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script>
        function enableCreateUser() {
            // file input 1
            if (document.getElementById("filecheck").checked) {
                document.getElementById("file-input1").disabled = false;
            } else {
                document.getElementById("file-input1").disabled = true;
            }
            // file input 2
            if (document.getElementById("filecheck2").checked) {
                document.getElementById("file-input2").disabled = false;
            } else {
                document.getElementById("file-input2").disabled = true;
            }
            // file input 3
            if (document.getElementById("filecheck3").checked) {
                document.getElementById("file-input3").disabled = false;
            } else {
                document.getElementById("file-input3").disabled = true;
            }
            // file input 4
            if (document.getElementById("filecheck4").checked) {
                document.getElementById("file-input4").disabled = false;
            } else {
                document.getElementById("file-input4").disabled = true;
            }
            // file input 5
            if (document.getElementById("filecheck5").checked) {
                document.getElementById("file-input5").disabled = false;
            } else {
                document.getElementById("file-input5").disabled = true;
            }

        }
    </script>


@endsection
