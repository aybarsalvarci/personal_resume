<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Yönetim Paneli</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/back/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="/back/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/back/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="/back/dist/css/custom.min.css">
    <link rel="stylesheet" href="{{asset('back/plugins/sweetalert2/sweetalert2.min.css')}}">
    @stack('css')

</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed">
<div class="animated-bg"></div>
<div class="grid-overlay"></div>

<div class="wrapper">

    <!-- Preloader -->
    <div class="loading-screen">
        <div class="loader-container">
            <div class="main-loader"></div>
            <div class="loader-text">Sistem Yükleniyor...</div>
        </div>
    </div>


    <!-- Navbar -->
    @include('admin.layouts.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('admin.layouts.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('breadcrumb-title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @yield('breadcrumb-links')
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="/back/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/back/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="/back/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="/back/dist/js/adminlte.js"></script>

<script src="{{asset('back/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- PAGE PLUGINS -->
@stack('js')

<script>
    window.addEventListener('load', function () {
        const loader = document.querySelector('.loading-screen');

        setTimeout(() => {
            loader.classList.add('hidden');

            @if(session()->has('success'))
            Swal.fire({
                title: 'Başarılı!',
                text: "{{ session('success') }}",
                icon: 'success',
                background: '#1a1e2b',
                color: '#fff',
                confirmButtonColor: '#3498db',
                confirmButtonText: 'Tamam'
            });
            @endif

            @if(session()->has('error'))
            Swal.fire({
                title: 'Hata!',
                text: "{{ session('error') }}",
                icon: 'error',
                background: '#1a1e2b',
                color: '#fff',
                confirmButtonColor: '#3498db',
                confirmButtonText: 'Tamam'
            });
            @endif

        }, 100);
    });
</script>
</body>
</html>
