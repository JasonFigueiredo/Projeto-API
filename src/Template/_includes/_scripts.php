<!-- jQuery -->
<script src="../../Template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../Template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../Template/dist/js/demo.js"></script>
<script src="../../Template/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../Template/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"
            }
        });
    });
</script>