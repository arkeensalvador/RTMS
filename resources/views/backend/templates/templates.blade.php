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
                            <li class="breadcrumb-item active">Templates</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Templates</h3>
                                <div class="card-tools">
                                    <a class="btn btn-success uploadFiles" data-toggle="modal" data-target='#uploadfiles'><i
                                            class="fa-solid fa-plus"></i> Add</a>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="programs" class="table table-bordered table-striped text-left">
                                    <thead>
                                        <tr>
                                            <th hidden>Template ID</th>
                                            <th>File Name</th>
                                            <th hidden>File Path</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($all as $key => $row)
                                            <tr>
                                                <td hidden>{{ $row->id }}</td>
                                                <td>{{ $row->file_name }}</td>
                                                <td hidden>{{ $row->file_path }}</td>
                                                <td class="action">
                                                    <a href="{{ url('download/' . $row->id) }}" class="btn btn-info">
                                                        <i class="fa-solid fa-download"></i>
                                                    </a>

                                                    {{-- <a href="{{ URL::to('/delete-file/' . $row->id) }}"
                                                        class="btn btn-danger" id="delete"><i
                                                            class="fa-solid fa-trash"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <!-- /.card-footer -->
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

    <!-- Add FIles Modal -->
    <div class="modal fade" id="uploadfiles" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Templates</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row files">
                    <div class="col-lg-12">
                        <form id="multi-file-upload-ajax" method="POST" action="javascript:void(0)" accept-charset="utf-8"
                            enctype="multipart/form-data">

                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="files[]" id="files"
                                            placeholder="Choose files" multiple>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        aria-label="Close">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#multi-file-upload-ajax').submit(function(e) {

                e.preventDefault();

                var formData = new FormData(this);

                let TotalFiles = $('#files')[0].files.length; //Total files
                let files = $('#files')[0];
                for (let i = 0; i < TotalFiles; i++) {
                    formData.append('files' + i, files.files[i]);
                }
                formData.append('TotalFiles', TotalFiles);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('store-multi-file-ajax') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'File Uploaded Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                $("#uploadfiles").modal().hide();
                                $('.modal-backdrop').remove();
                                window.location.href = '/all-templates';
                            }
                        });
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            toast: true,
                            iconColor: 'white',
                            position: 'top-end',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            // title: data.responseJSON.message,
                            text: data.responseJSON.message,
                            // title: 'There is something wrong...',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 2000
                        });

                    }
                });
            });
        });
    </script>
@endsection
