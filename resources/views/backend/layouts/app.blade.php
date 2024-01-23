<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <link rel="icon" href="{{ asset('backend/dist/img/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free-6.3.0-web/css/all.min.css') }}">

    {{-- <script src="https://kit.fontawesome.com/403b4fe327.js" crossorigin="anonymous"></script> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    {{-- Toastr & Sweet Alert --}}
    <link rel="stylesheet" href="{{ asset('toaster/toastr.min.css') }}">

    {{-- Select2 --}}

    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">

    {{-- bs stepper --}}

    <link rel="stylesheet" href="{{ asset('backend/plugins/bs-stepper/css/bs-stepper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/chart.js/Chart.css') }}">

    {{-- iCheck --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css" />

    {{-- CSS --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">


    {{-- DropZone --}}
    {{-- <link rel="stylesheet" href="{{ asset('backend/plugins/dropzone/min/dropzone.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.0/dropzone.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    {{-- BS Tags input --}}
    <link rel="stylesheet" href="{{ asset('backend/plugins/bs-tags-input/bootstrap-tagsinput.css') }}">

    {{-- Flat Pickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>





    <style>
        .form-control,
        .form-control:focus,
        .input-group-addon {
            border-color: #e1e1e1;
            border-radius: 0;
        }

        .signup-form {
            width: 50%;
            margin: 0 auto;
            padding: 30px 0;
        }

        .signup-form h2 {
            color: #636363;
            margin: 0 0 15px;
            text-align: center;
        }

        .signup-form .lead {
            font-size: 14px;
            margin-bottom: 30px;
            text-align: center;
        }

        .signup-form form {
            border-radius: 1px;
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #f3f3f3;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form label {
            font-weight: normal;
            font-size: 13px;
        }

        .signup-form .form-control {
            min-height: 38px;
            box-shadow: none !important;
            border-width: 0 0 1px 0;
        }

        .signup-form .input-group-addon {
            max-width: 42px;
            text-align: center;
            background: none;
            border-bottom: 1px solid #e1e1e1;
            padding-left: 5px;
        }

        .signup-form .btn,
        .signup-form .btn:active {
            font-size: 16px;
            font-weight: bold;
            background: #19aa8d !important;
            border-radius: 3px;
            border: none;
            min-width: 140px;
        }

        .signup-form .btn:hover,
        .signup-form .btn:focus {
            background: #179b81 !important;
        }

        .signup-form a {
            color: #19aa8d;
            text-decoration: none;
        }

        .signup-form a:hover {
            text-decoration: underline;
        }

        .signup-form .fa {
            font-size: 21px;
            position: relative;
            top: 8px;
        }

        .form-control,
        .form-control:focus,
        .input-group-addon {
            border-color: #e1e1e1;
            border-radius: 0;
        }

        .signup-form {
            width: 50%;
            margin: 0 auto;
            padding: 30px 0;
        }

        .signup-form h2 {
            color: #636363;
            margin: 0 0 15px;
            text-align: center;
        }

        .signup-form .lead {
            font-size: 14px;
            margin-bottom: 30px;
            text-align: center;
        }

        .signup-form form {
            border-radius: 1px;
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #f3f3f3;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .signup-form .form-group {
            margin-bottom: 20px;
        }

        .signup-form label {
            font-weight: normal;
            font-size: 13px;
        }

        .signup-form .form-control {
            min-height: 38px;
            box-shadow: none !important;
            border-width: 0 0 1px 0;
        }

        .signup-form .input-group-addon {
            max-width: 42px;
            text-align: center;
            background: none;
            border-bottom: 1px solid #e1e1e1;
            padding-left: 5px;
        }

        .signup-form .btn,
        .signup-form .btn:active {
            font-size: 16px;
            font-weight: bold;
            background: #19aa8d !important;
            border-radius: 3px;
            border: none;
            min-width: 140px;
        }

        .signup-form .btn:hover,
        .signup-form .btn:focus {
            background: #179b81 !important;
        }

        .signup-form a {
            color: #19aa8d;
            text-decoration: none;
        }

        .signup-form a:hover {
            text-decoration: underline;
        }

        .signup-form .fa {
            font-size: 21px;
            position: relative;
            top: 8px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .currencyinput {
            border: 1px inset #ccc;
        }

        .currencyinput input {
            border: 0;
        }

        #regiration_form fieldset:not(:first-of-type) {
            display: none;
        }



        .icheck-success.rad {
            padding-left: 20px;
            padding-top: 3px;
        }

        .loader {
            --cell-size: 52px;
            --cell-spacing: 1px;
            --cells: 3;
            --total-size: calc(var(--cells) * (var(--cell-size) + 2 * var(--cell-spacing)));
            display: flex;
            flex-wrap: wrap;
            width: var(--total-size);
            height: var(--total-size);
        }

        .cell {
            flex: 0 0 var(--cell-size);
            margin: var(--cell-spacing);
            background-color: transparent;
            box-sizing: border-box;
            border-radius: 4px;
            animation: 1s ripple ease infinite;
        }

        .cell.d-1 {
            animation-delay: 100ms;
        }

        .cell.d-2 {
            animation-delay: 150ms;
        }

        .cell.d-3 {
            animation-delay: 200ms;
        }

        .cell.d-4 {
            animation-delay: 250ms;
        }

        .cell:nth-child(1) {
            --cell-color: #00FF87;
        }

        .cell:nth-child(2) {
            --cell-color: #0CFD95;
        }

        .cell:nth-child(3) {
            --cell-color: #17FBA2;
        }

        .cell:nth-child(4) {
            --cell-color: #23F9B2;
        }

        .cell:nth-child(5) {
            --cell-color: #30F7C3;
        }

        .cell:nth-child(6) {
            --cell-color: #3DF5D4;
        }

        .cell:nth-child(7) {
            --cell-color: #45F4DE;
        }

        .cell:nth-child(8) {
            --cell-color: #53F1F0;
        }

        .cell:nth-child(9) {
            --cell-color: #60EFFF;
        }

        /*Animation*/
        @keyframes ripple {
            0% {
                background-color: transparent;
            }

            30% {
                background-color: var(--cell-color);
            }

            60% {
                background-color: transparent;
            }

            100% {
                background-color: transparent;
            }
        }

        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }

        .colored-toast.swal2-icon-error {
            background-color: #f27474 !important;
        }

        .colored-toast.swal2-icon-warning {
            background-color: #f8bb86 !important;
        }

        .colored-toast.swal2-icon-info {
            background-color: #3fc3ee !important;
        }

        .colored-toast.swal2-icon-question {
            background-color: #87adbd !important;
        }

        .colored-toast .swal2-title {
            color: white;
        }

        .colored-toast .swal2-close {
            color: white;
        }

        .colored-toast .swal2-html-container {
            color: white;
        }

        .sweet_loader {
            width: 140px;
            height: 140px;
            margin: 0 auto;
            animation-duration: 0.5s;
            animation-timing-function: linear;
            animation-iteration-count: infinite;
            animation-name: ro;
            transform-origin: 50% 50%;
            transform: rotate(0) translate(0, 0);
        }

        @keyframes ro {
            100% {
                transform: rotate(-360deg) translate(0, 0);
            }
        }
    </style>

</head>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer">
    <div class="wrapper">

        @include('sweetalert::alert')
        <!-- Navbar -->
        @include('backend.layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('backend.layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        {{-- @include('backend.layouts.dashboard') --}}
        @yield('content')
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer text-sm">
            <strong>Copyright &copy; 2023 <a
                    href="http://pcaarrd.dost.gov.ph/index.php/claarrdec">CLAARRDEC</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 2.0
            </div>
        </footer>
    </div>
    <!-- ./wrapper -->


    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    {{-- <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.js') }}"></script>

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <script src="{{ asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('backend/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

    <script src="{{ asset('backend/plugins/inputmask/inputmask.js') }}"></script>
    <script src="{{ asset('backend/plugins/inputmask/inputmask.es6.js') }}"></script>
    <script src="{{ asset('backend/plugins/inputmask/inputmask.min.js') }}"></script>
    <script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>

    {{-- bs stepper --}}
    <script src="{{ asset('backend/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>

    {{-- Repeater --}}
    <script src="{{ asset('backend/plugins/jquery-repeater-master/repeater.js') }}"></script>

    {{-- Select2 --}}
    <script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>

    {{-- sweet alert start --}}
    <script src="{{ asset('toaster/toastr.min.js') }}"></script>
    <script src="{{ asset('toaster/sweetalert.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    {{-- Dropzone --}}
    {{-- <script src="{{ asset('backend/plugins/dropzone/min/dropzone.css') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- ChartJS -->
    <script src="{{ asset('backend/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{asset('backend/dist/js/demo.js')}}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('backend/dist/js/pages/dashboard2.js') }}"></script>

    {{-- dropzone --}}
    {{-- <script src="{{ asset('backend/plugins/dropzone/min/dropzone.min.js') }}"></script> --}}

    {{-- BS tags input --}}
    <script src="{{ asset('backend/plugins/bs-tags-input/bootstrap-tagsinput.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
</body>

{{-- /* The code below is using the flatpickr library to add date pickers to HTML elements with specific
classes. */ --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('.date', {
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            // minDate: "today",
        });

        flatpickr('.date-range', {
            dateFormat: 'm/d/Y',
            altInput: true,
            altFormat: "F j, Y",
            allowInput: true,
            mode: "range"
        });

        flatpickr('.duration', {
            dateFormat: 'm/d/Y',
            altInput: true,
            altFormat: "F j, Y",
            allowInput: false,
            mode: "range"
        });

        flatpickr(".year", {
            enableTime: false,
            dateFormat: "Y",
            minDate: "1900",
            maxDate: "2100",
            minDate: new Date().getFullYear() // Set a minimum date if need
        });
    });
</script>


{{-- /* The code below is a JavaScript function that formats a number input in a specific way. */ --}}
<script>
    function formatNumber(e) {
        var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
            val = this.value.replace(/^0+|\.|,/g, ""),
            res;

        if (val.length) {
            res = Array.prototype.reduce.call(val, (p, c) => c + p) // reverse the pure numbers string
                .match(rex) // get groups in array
                .reduce((p, c, i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
            res += /\.|,/.test(res) ? "" : ".0"; // test if res has (.) or (,) in it
            this.value = Array.prototype.reduce.call(res, (p, c) => c + p); // reverse the string and display
        }
    }

    var ni = document.getElementById("numin");

    ni.addEventListener("keyup", formatNumber);

    var ni2 = document.getElementById("numin2");

    ni2.addEventListener("keyup", formatNumber);
</script>

{{-- /* The code below is written in JavaScript and it is binding a keypress event to all forms on the page.
When the user presses the enter key (keyCode 13), the code retrieves the value of the submit button
with the id "submit" and returns it. It also prevents the default behavior of the enter key, which
is to submit the form. */ --}}
<script>
    $("form").bind("keypress", function(e) {
        if (e.keyCode == 13) {
            $("#submit").attr('value');
            //add more buttons here
            return false;
        }
    });
</script>

{{-- /* The code below is a JavaScript function called `enableCreateUser()`. It is used to enable or disable
file input fields based on the state of corresponding checkboxes. */ --}}
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

{{-- /* The code below is using the jQuery library to initialize and configure various select2 dropdown
menus. Select2 is a jQuery-based replacement for select boxes that provides a customizable and
feature-rich user interface for selecting options. */ --}}
<script>
    $(document).ready(function() {
        $('.yearSelect').select2({
            placeholder: "Select Year",
            allowClear: false
        });

        $('.agency').select2({
            placeholder: "Select Agency",
            allowClear: false
        });

        $('.source').select2({
            placeholder: "Select Source",
            allowClear: false
        });

        $('.formtype').select2({
            placeholder: "Select",
            allowClear: false,
            minimumResultsForSearch: -1
        });

        $('.year').select2({
            placeholder: "Select Year",
            allowClear: false
        });

        $('.program_leader').select2({
            placeholder: "Select Program Leader",
            allowClear: false
        });

        $('.keywords').select2({
            placeholder: "Enter keyword(s) related to program",
            allowClear: true,
            tags: true,
        });

        $('.researchers').select2({
            placeholder: "Select researcher",
            allowClear: false,
            minimumResultsForSearch: 1
        });

        $('.others').select2({
            placeholder: "Select type",
            minimumResultsForSearch: -1
        });

        $('.fod').select2({
            placeholder: "Select",
            minimumResultsForSearch: -1
        });



        $('.type').select2({
            placeholder: "Select",
            minimumResultsForSearch: -1
        });
        $('.status').select2({
            placeholder: "Select status",
            minimumResultsForSearch: -1
        });
        $('.chooser').select2({
            // minimumResultsForSearch: -1
        });

        $('.projects').select2({
            placeholder: "Select projects",
            allowClear: false,
        });


        $('.programs').select2({
            placeholder: "Select programs",
            minimumResultsForSearch: -1
        });

        $(document).ready(function() {
            $('.js-recipients').select2({
                placeholder: 'Select recipients',
                tags: true,
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('#form_of_development').select2({
                placeholder: 'Select',
            });
        });



        $(document).ready(function() {
            $('.research-center').select2({
                tags: true,
                allowClear: true,
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-single').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: 'Enter recipients',

            });

            $('.recipient').select2({
                placeholder: "Select recipients",
                allowClear: false
            });

            $('.regional-researchers').select2({
                tags: true,
                tokenSeparators: [',', ' '],
                placeholder: 'Enter recipients'

            });
        });

        $(document).ready(function() {
            $('.implementing_agency').select2({
                // tags: true,
                // tokenSeparators: [',', ' '],
                allowClear: false,
                placeholder: "Select implementing agency"
            });

            $('#act_donor').select2({
                allowClear: false,
                placeholder: "Select donor"
            });

            $('#funding_agency').select2({
                // tags: true,
                // tokenSeparators: [',', ' '],
                allowClear: false,
                placeholder: "Select funding agency"
            });

            $('.collaborating_agency').select2({
                // tags: true,
                // tokenSeparators: [',', ' '],
                allowClear: false,
                placeholder: "Select collaborating agency"
            });
        });
    });
</script>

{{-- /* The code below is a JavaScript function called "isNumberKey" that is used to validate whether the
key pressed is a number or not. It takes an event object as a parameter and checks the character
code of the key pressed. If the character code is between 48 and 57 (which corresponds to the ASCII
values of digits 0-9), it returns true, indicating that it is a number. Otherwise, it returns false,
indicating that it is not a number. */ --}}
<script>
    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>

{{-- /* The code below is written in PHP and JavaScript. It checks if there is a session message set in the
PHP code. If there is a message, it retrieves the message and the alert type from the session. */ --}}
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                Swal.fire({
                    icon: 'info',
                    title: "{{ Session::get('message') }}",
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 900
                })
                // toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                Swal.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}",
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 900
                })
                // toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                Swal.fire({
                    icon: 'warning',
                    title: "{{ Session::get('message') }}",
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 900
                })

                // toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                Swal.fire({
                    icon: 'error',
                    title: "{{ Session::get('message') }}",
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 900
                })

                // toastr.error("{{ Session::get('message') }}");
                break;

            case 'test':
                Swal.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}",
                    text: 'Are there any Project associated with this Program?',
                    showDenyButton: true,
                    showCloseButton: true,
                    confirmButtonText: 'Yes',
                    denyButtontext: 'No',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'program-projects-add';
                    }
                });
                break;

            case 'project':
                Swal.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}",
                    text: 'Are there any studies/sub-projects associated with this Project?',
                    // type: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'None',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        window.location.href = '/sub-projects-add';
                    }
                    // else {
                    //     window.location.href = 'projects-add';
                    // }
                });

                // toastr.success("{{ Session::get('message') }}");
                break;

            case 'project':
                Swal.fire({
                    icon: 'success',
                    title: "{{ Session::get('message') }}",
                    text: 'Are there any studies/sub-projects associated with this Project?',
                    // type: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'None',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        window.location.href = 'sub-projects-add';
                    }
                    // else {
                    //     window.location.href = 'projects-add';
                    // }
                });

                // toastr.success("{{ Session::get('message') }}");
                break;
        }
    @endif
</script>

{{-- /* The code below is written in JavaScript and it is using jQuery library. */ --}}
<script>
    $('#chooseFile').change(function() {
        var i = $(this).prev('label').clone();
        var file = $('#file-upload')[0].files[0].name;
        $(this).prev('label').text(file);
    });
</script>

{{-- /* The code below is written in PHP and JavaScript. */ --}}
<script>
    $(document).ready(function() {
        var stepper = new Stepper($('.bs-stepper')[0])
    })

    $("#repeater").createRepeater({
        showFirstItemToDefault: true,
    });
</script>
{{-- 
/* The code below is written in PHP and JavaScript. It is handling two different events: deleting an
item and logging out. */ --}}
<script>
    $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            dangerMode: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            allowEscapeKey: false,
            allowOutsideClick: false,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
            }
        })
    });

    $(document).on("click", "#btn-logout", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
                title: 'Are you sure you want to Logout?',
                icon: 'warning',
                buttons: true,
                confirmButtonText: 'Yes',
                showCancelButton: true,
                dangerMode: true,
                allowEscapeKey: false,
                allowOutsideClick: false,
            })
            .then((result) => {
                if (result.value === true) {
                    Swal.fire({
                        text: 'Logging out...',
                        buttons: false,
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        timer: 900,
                        didOpen: () => {
                            Swal.showLoading()
                        },
                        willClose: () => {
                            document.getElementById('logout-form').submit();
                        }
                    })
                }
            });
    });
</script>

{{-- /* The code below is written in JavaScript and is using the SweetAlert library to display a loading
message and then a success message after a certain delay. */ --}}
<script>
    $(document).on('click', '.sweet-alert-trigger', function() {
        swal.fire({
            html: '<h4>Loading...</h4>',
            onRender: function() {
                prepend(sweet_loader);
            }
        });
        setTimeout(function() {
            swal.fire({
                icon: 'success',
                html: '<h4>Success!</h4>'
            });
        }, 700);
    });
</script>

{{-- /* The code below is using the DataTables plugin in jQuery to enhance the functionality of HTML tables.
It is initializing multiple tables with different configurations and adding buttons for exporting
data in various formats (copy, csv, excel, pdf, print) and for column visibility control (colvis). */ --}}
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
        });

        $("#aihrs").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": false,
            "buttons": ["csv", "excel", "pdf", "print"]
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#aihrs_wrapper .col-md-6:eq(0)');

        $('#accounts').DataTable({
            "paging": true,
            "lengthChange": false,
            "responsive": true,
            "autoWidth": false,
            "info": true,
            buttons: {
                buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, "colvis"]
            },
            columnDefs: [{
                targets: 0,
                visible: false
            }]

            // "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#accounts_wrapper .col-md-6:eq(0)');

        $('#projects').DataTable({
            "paging": true,
            "lengthChange": false,
            "responsive": true,
            "autoWidth": false,
            "info": true,
            buttons: {
                buttons: [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, "colvis"]
            },
            columnDefs: [{
                targets: 0,
                visible: false
            }]

            // "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#projects_wrapper .col-md-6:eq(0)');
        $('#programs').DataTable({
            "paging": true,
            "lengthChange": false,
            "responsive": true,
            "autoWidth": false,
            "info": true,
            buttons: {
                buttons: [{
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: ':visible'
                    }
                }, "colvis"]
            },
            columnDefs: [{
                // targets: 0,
                visible: false
            }]

            // "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#programs_wrapper .col-md-6:eq(0)');
    });

    $(document).ready(function() {

    });
</script>

{{-- /* The code below is written in PHP and JavaScript. It is using the jQuery library to apply input masks
to certain form fields. */ --}}
<script>
    $(document).ready(function() {
        $('#start_date').inputmask("99/99/9999", {
            inputFormat: "mm/dd/yyyy",
            placeholder: 'mm/dd/yyyy'
        });

        $('#end_date').inputmask("99/99/9999", {
            inputFormat: "mm/dd/yyyy",
            placeholder: 'mm/dd/yyyy'
        });

        $('#contact[]').inputmask("0999-999-9999");


    });
</script>





</html>
