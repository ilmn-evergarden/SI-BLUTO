<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="{{ asset('images/logo-mini.png') }}">

</head>

<body>

    <div class="container-scroller">

        @include('layouts.kepala.navbar')

        <div class="container-fluid page-body-wrapper">

            @include('layouts.kepala.sidebar')

            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('content')

                </div>

                @include('layouts.kepala.footer')
            </div>

            <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
            <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
            <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
            <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
            <script src="{{ asset('js/dataTables.select.min.js') }}"></script>
            <script src="{{ asset('js/off-canvas.js') }}"></script>
            <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
            <script src="{{ asset('js/template.js') }}"></script>
            <script src="{{ asset('js/settings.js') }}"></script>
            <script src="{{ asset('js/todolist.js') }}"></script>
            <script src="{{ asset('js/dashboard.js') }}"></script>
            <script src="{{ asset('js/Chart.roundedBarCharts.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
