<!DOCTYPE html>
<html>
<head>
    @include('user.layouts.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

{{--Main header--}}
@include('user.modules.header')

<!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
@include('user.modules.sidebar')

<!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')

    </div>
    <!-- /.content-wrapper -->


    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@include('user.layouts.footer')

@yield('javascript')

</body>
</html>
