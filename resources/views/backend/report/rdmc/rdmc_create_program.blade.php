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

            <div class="strategic row">

                <div class="col-md-8">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add Program
                            </h5>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="#" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>ProgramID</label>
                                                {{-- Route::input('name'); --}}
                                                <input type="text" class="form-control"
                                                    value="<?= substr(md5(microtime()), 0, 10) ?>" disabled
                                                    placeholder="Enter code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Fund Code</label>
                                                <input type="text" class="form-control" placeholder="Enter code">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="On-going">On-going</option>
                                                    <option value="Terminated">Terminated</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="Research Category">Research Category</option>
                                                    <option value="Development Category">Development Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Program Title</label>
                                                <textarea name="" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Funding Agency</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Agency 1</option>
                                                    <option value="">Agency 2</option>
                                                    <option value="">Agency 3</option>
                                                    <option value="">Agency 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Coordination Fund</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>

                                    <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />

                                    <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                    <!-- /.card-body -->


                                    {{-- Page2 --}}
                                </fieldset>

                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Program Leader</label>
                                                <input type="text" class="form-control" placeholder="Program Leader"
                                                    list="leaderdtlist">
                                                <datalist id="leaderdtlist">
                                                    <option value="Leader 1"><span>Agency</span></option>
                                                    <option value="Leader 2"></option>
                                                    <option value="Leader 3"></option>
                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Program Staff</label>
                                                <input type="text" class="form-control" placeholder="Program Staffs">
                                            </div>
                                        </div>

                                        <div class="col staffs">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Program Staff</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Program Staffs">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Program Staff</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Program Staffs">
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Program Staff</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Program Staffs">
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Program Title</label>
                                                <textarea name="" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Funding Agency</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Agency 1</option>
                                                    <option value="">Agency 2</option>
                                                    <option value="">Agency 3</option>
                                                    <option value="">Agency 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Coordination Fund</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-default"
                                        value="Previous" />
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                </fieldset>
                        </div>
                        </form>
                    </div> {{-- card body end --}}
                </div>{{-- card end --}}
            </div>
            <div class="col-lg-1">

            </div>
    </div>

    </section>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
