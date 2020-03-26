<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/js/demo.js') }}"></script>
<!-- plugin chart.js-->
<script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js') }}"></script>
<!-- DataTables JS-->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<!--Jquery UI -->
<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.js') }}"></script>

<!-- Local Custom JS -->
@yield('dashboardjs')
@yield('productjs')
@yield('transactionjs')
@yield('reportsjs')

<!-- Global Custom JS -->
<script>
  $('#message').delay(3000).fadeOut(300);
</script>