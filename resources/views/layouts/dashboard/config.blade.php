<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kanindo Syariah</title>
    <link rel="shortcut icon" href="{{ asset('img/logo.jpg') }}" type="image/x-icon">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> --}}


    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('modules/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/owlcarousel2/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/owlcarousel2/dist/assets/owl.theme.default.min.css') }}">


    {{-- Data Table --}}

    <link rel="stylesheet" href="{{ asset('modules/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

    {{-- End Data Table --}}

    {{-- Toast --}}
    <link rel="stylesheet" href="{{ asset('modules/izitoast/css/iziToast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

</head>
</head>

<body>

    <div id="app">
        @include('layouts.dashboard.nav')
        @include('layouts.dashboard.sidebar')
        {{ $slot }}

        @include('layouts.dashboard.footer')

    </div>

    <script src="{{ asset('modules/jquery.min.js') }}"></script>
    <script src="{{ asset('modules/popper.js') }}"></script>
    <script src="{{ asset('modules/tooltip.js') }}"></script>
    <script src="{{ asset('modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('modules/moment.min.js') }}"></script>
    <script src="{{ asset('js/stisla.js') }}"></script>

    <script src="{{ asset('modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('modules/jquery-ui/jquery-ui.min.js') }}"></script>


    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>

    <script src="{{ asset('modules/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('modules/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('modules/chart.min.js') }}"></script>
    <script src="{{ asset('modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('modules/owlcarousel2/dist/owl.carousel.min.js') }}"></script>

    {{-- Modal --}}
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>

    {{-- Toast  --}}
    <script src="{{ asset('modules/izitoast/js/iziToast.min.js') }}"></script>
    <script src="{{ asset('js/page/modules-toastr.js') }}"></script>


    <script src="{{ asset('js/page/index.js') }}"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>





</body>

</html>
