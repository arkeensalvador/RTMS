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
                                Technology Promotion Approaches
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ url('update-tpa/'.$all->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Title</label>
                                            <textarea class="form-control" name="tpa_title" rows="3" placeholder="Enter ...">{{ $all->tpa_title }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Date</label>
                                            <input type="date" name="tpa_date" class="form-control"
                                                placeholder="Enter ..." value="{{ $all->tpa_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Details</label>
                                            <textarea class="form-control" name="tpa_details" rows="3" placeholder="Enter ...">{{ $all->tpa_details }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea class="form-control" name="tpa_remarks" rows="3" placeholder="Enter ...">{{ $all->tpa_remarks }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $approach = json_decode($all->tpa_approaches);
                                @endphp
                                <label>IEC Approaches</label>
                                <div class="ttm row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Regional FIESTA" name="tpa_approaches[]"
                                                    id="customCheckbox1"
                                                    {{ in_array('Regional FIESTA', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox1" class="custom-control-label">Regional
                                                    FIESTA</label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Fairs" name="tpa_approaches[]"
                                                    id="customCheckbox2"
                                                    {{ in_array('Fairs', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox2" class="custom-control-label">Fairs</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Exhibits" name="tpa_approaches[]"
                                                    id="customCheckbox3"
                                                    {{ in_array('Exhibits', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox3" class="custom-control-label">Exhibits</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Media Conference" name="tpa_approaches[]"
                                                    id="customCheckbox4"
                                                    {{ in_array('Media Conference', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox4" class="custom-control-label">Media
                                                    Conference</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Farmers' Fora" name="tpa_approaches[]"
                                                    id="customCheckbox5"
                                                    {{ in_array("Farmers' Fora" , $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox5" class="custom-control-label">Farmers'
                                                    Fora</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="IEC Materials" name="tpa_approaches[]"
                                                    id="customCheckbox6"
                                                    {{ in_array('IEC Materials', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox6" class="custom-control-label">IEC
                                                    Materials</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Press Release" name="tpa_approaches[]"
                                                    id="customCheckbox7"
                                                    {{ in_array('Press Release', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox7" class="custom-control-label">Press
                                                    Release</label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Publications in Newspaper"
                                                    name="tpa_approaches[]" id="customCheckbox8"
                                                    {{ in_array('Publications in Newspaper', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox8" class="custom-control-label">Publications in
                                                    Newspaper</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Magazines" name="tpa_approaches[]"
                                                    id="customCheckbox9"
                                                    {{ in_array('Magazines', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox9"
                                                    class="custom-control-label">Magazines</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Comics" name="tpa_approaches[]"
                                                    id="customCheckbox10"
                                                    {{ in_array('Comics', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox10" class="custom-control-label">Comics</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Others" name="tpa_approaches[]"
                                                    id="customCheckbox11"
                                                    {{ in_array('Others', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox11" class="custom-control-label">Others</label>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Broadcast Media" name="tpa_approaches[]"
                                                    id="customCheckbox12"
                                                    {{ in_array('Broadcast Media', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox12" class="custom-control-label">Broadcast
                                                    Media</label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Radio" name="tpa_approaches[]"
                                                    id="customCheckbox13"
                                                    {{ in_array('Radio', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox13" class="custom-control-label">Radio</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Television" name="tpa_approaches[]"
                                                    id="customCheckbox14"
                                                    {{ in_array('Television', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox14"
                                                    class="custom-control-label">Television</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="News Features" name="tpa_approaches[]"
                                                    id="customCheckbox15"
                                                    {{ in_array('News Features', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox15" class="custom-control-label">News
                                                    Features</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="School on the Air" name="tpa_approaches[]"
                                                    id="customCheckbox16"
                                                    {{ in_array('School on the Air', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox16" class="custom-control-label">School on the
                                                    Air</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Interview Guesting" name="tpa_approaches[]"
                                                    id="customCheckbox17"
                                                    {{ in_array('Interview Guesting', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox17" class="custom-control-label">Interview
                                                    Guesting</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="ICT-based ICT" name="tpa_approaches[]"
                                                    id="customCheckbox18"
                                                    {{ in_array('ICT-based ICT', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox18" class="custom-control-label">ICT-based
                                                    ICT</label>
                                            </div>

                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="CDs & Optimal Media" name="tpa_approaches[]"
                                                    id="customCheckbox19"
                                                    {{ in_array('CDs & Optimal Media', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox19" class="custom-control-label">CDs & Optimal
                                                    Media</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Web-based Formats" name="tpa_approaches[]"
                                                    id="customCheckbox20"
                                                    {{ in_array('Web-based Formats', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox20" class="custom-control-label">Web-based
                                                    Formats</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input custom-control-input-success"
                                                    type="checkbox" value="Online Promotion" name="tpa_approaches[]"
                                                    id="customCheckbox21"
                                                    {{ in_array('Online Promotion', $approach) ? 'checked' : '' }}>
                                                <label for="customCheckbox21" class="custom-control-label">Online
                                                    Promotion</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ url('rdru-tpa') }}" class="btn btn-default">Back</a>
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                        </div>
                    </div>
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
