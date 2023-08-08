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
                                Equipment and Facilities
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ url('update-equipment/' . $all->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf

                                @php
                                    $type = json_decode($all->equipments_type);
                                @endphp
                                <div class="ttm row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Regional FIESTA" name="equipments_type[]"
                                                    id="customCheckbox1"
                                                    {{ in_array('Regional FIESTA', $type) ? 'checked' : '' }}>
                                                <label for="customCheckbox1" class="custom-control-label">Regional
                                                    FIESTA</label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Fairs" name="equipments_type[]"
                                                    id="customCheckbox2" {{ in_array('Fairs', $type) ? 'checked' : '' }}>
                                                <label for="customCheckbox2" class="custom-control-label">Fairs</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Exhibits" name="equipments_type[]"
                                                    id="customCheckbox3" {{ in_array('Exhibits', $type) ? 'checked' : '' }}>
                                                <label for="customCheckbox3" class="custom-control-label">Exhibits</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input custom-control-input-success" type="checkbox"
                                                value="Media Conference" name="equipments_type[]" id="customCheckbox4" {{ in_array('Media Conference', $type) ? 'checked' : '' }}>
                                            <label for="customCheckbox4" class="custom-control-label">Media
                                                Conference</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input custom-control-input-success" type="checkbox"
                                                value="Farmers' Fora" name="equipments_type[]" id="customCheckbox5"
                                                {{ in_array("Farmers' Fora", $type) ? 'checked' : '' }}>
                                            <label for="customCheckbox5" class="custom-control-label">Farmers'
                                                Fora</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Equipment Name</label>
                                            <input type="text" name="equipments_name" class="form-control"
                                                placeholder="Enter ..." value="{{ $all->equipments_name }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Expenditures</label>
                                            <input type="text" name="equipments_total" id="numin"
                                                class="form-control" value="{{ $all->equipments_total }}"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Source of Fund</label>
                                            <input type="text" name="equipments_sof" class="form-control"
                                                placeholder="Enter ..." list="funddtlist"
                                                value="{{ $all->equipments_sof }}">
                                            <datalist id="funddtlist">
                                                <option value="DOST-PCAARRD"></option>
                                                <option value="Department of Agriculture - Bayanihan Act"></option>
                                            </datalist>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Agency</label>
                                            <select name="equipments_agency" id="" class="form-control agency">
                                                <option></option>
                                                @foreach ($agency as $key)
                                                    <option value="{{ $key->abbrev }}"
                                                        {{ $key->abbrev == $all->equipments_agency ? 'selected' : '' }}>
                                                        {{ $key->agency_name }} -
                                                        ({{ $key->abbrev }})
                                                        </b></option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('cbg-equipment') }}" class="btn btn-default">Back</a>
                                <input type="submit" name="submit" class="submit btn btn-success" value="Update" />
                                <!-- /.card-body -->
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