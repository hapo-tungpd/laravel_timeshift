<!DOCTYPE html>
<html>
<head>
    @include('user.layouts.header')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
{{--@include('user.layouts.sidebar')--}}

{{--Main header--}}
@include('user.modules.header')

<!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
@include('user.modules.sidebar')
<!-- Right side column. contains the sidebar -->

<!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

@include('user.layouts.footer')
@yield('javascript')
@include('user.layouts.sidebar')

</body>
</html>
