<!-- jQuery 3 -->
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('js/jquery.slimscroll.min.js')}}"></script>
{{--  Sweet alert  --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{--  Toast  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
<!-- FastClick -->
<script src="{{asset('js/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('js/demo.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('js/ckeditor.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{asset('js/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
<script>
    $(document).ready(function () {
        $('.sidebar-menu').tree()
    });
</script>

<script>
    $(function() {
        $('.fa-sign-out').parent().on('click', function() {
            $('#logout-btn').trigger('click');
        });
    });
    $(".report-time-picker").datetimepicker({
        format: 'Y-m-d',
    });
</script>
