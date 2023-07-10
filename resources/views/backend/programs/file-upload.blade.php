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
                <div class="col-lg-5">

                    {{-- card start --}}
                    <div class="strategic card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Upload Files
                            </h5>
                        </div>
                        {{-- card body start --}}
                        <div class="card-body">
                            <form action="{{ URL::to('/upload-file')}}" method="post" enctype="multipart/form-data">
                                <h5 class="text-center mb-3">Upload File in Laravel</h5>
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
                                    value="{{ $program->programID }}" placeholder="Program ID" hidden readonly required
                                    autocomplete="false">

                                <div class="custom-file">
                                    <input type="file" class="form-control" name="file" id="chooseFile" required>
                                    <label class="custom-file-label" for="chooseFile">Select file</label>
                                </div>
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
        document.getElementById('value-1').onchange = function() {
            document.getElementById('file-upload1').disabled = !this.checked;
        };
        document.getElementById('value-2').onchange = function() {
            document.getElementById('file-upload1').disabled = this.checked;
        };

        document.getElementById('value-3').onchange = function() {
            document.getElementById('file-upload2').disabled = !this.checked;
        };
        document.getElementById('value-4').onchange = function() {
            document.getElementById('file-upload2').disabled = this.checked;
        };
        document.getElementById('value-5').onchange = function() {
            document.getElementById('file-upload3').disabled = !this.checked;
        };
        document.getElementById('value-6').onchange = function() {
            document.getElementById('file-upload3').disabled = this.checked;
        };
        document.getElementById('value-7').onchange = function() {
            document.getElementById('file-upload4').disabled = !this.checked;
        };
        document.getElementById('value-8').onchange = function() {
            document.getElementById('file-upload4').disabled = this.checked;
        };
    </script>


@endsection