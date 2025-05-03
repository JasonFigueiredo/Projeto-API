<!-- jQuery -->
<script src="../../Template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../Template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../Template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- Toastr -->
<script src="../../Template/plugins/toastr/toastr.min.js"></script>
<script src="../../Template/dist/js/demo.js"></script>
<script src="../../Template/plugins/datatables/jquery.dataTables.js"></script>
<script src="../../Template/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Mensagem script -->
<script src="../../Resource/js/mensagem.js"></script>
<script src="../../Resource/js/funcoes.js"></script>
<script src="../../Resource/js/carregar_modal.js"></script>
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

<script>
    // script para formatar o telefone e adicionar máscara
    document.getElementById('tel').addEventListener('input', function(e) {
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
</script>

<script>
    // Função para contar os caracteres do campo de observações e exibir a quantidade restante com base no atributo maxlength
    function countChars(textarea) {
        var maxLength = textarea.getAttribute('maxlength');
        var currentLength = textarea.value.length;
        var remainingChars = maxLength - currentLength;
        document.getElementById('charCount').textContent = remainingChars + ' caracteres restantes';
    }
</script>