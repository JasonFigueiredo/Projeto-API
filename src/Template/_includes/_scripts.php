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
<script src="../../Resource/js/extras.js"></script>
<script src="../../Resource/js/validar_email.js"></script>
<script src="../../Resource/ajax/usuario_ajax.js"></script>
<script src="../../Resource/js/validar_cpf.js"></script>
<script src="../../Resource/js/buscar_cep.js"></script>
<script src="../../Resource/ajax/usuario_ajax.js"></script>
<script src="../../Resource/ajax/setor_ajax.js"></script>
<script src="../../Resource/ajax/equipamento_ajax.js"></script>
<script src="../../Resource/ajax/tipo_equipamento_ajax.js"></script>
<script src="../../Resource/ajax/modelo_equipamento_ajax.js"></script>
<script src="../../Resource/js/navegacao_ativa.js"></script>


<style>
    /* Estilo para item ativo no menu */
    .nav-link.active {
        background-color: #007bff !important;
        color: #fff !important;
        border-radius: 5px;
        margin: 2px 0;
    }
    
    .nav-link.active .nav-icon {
        color: #fff !important;
    }
    
    .nav-link.active p {
        color: #fff !important;
        font-weight: bold;
    }
    
    /* Estilo para submenu aberto - apenas o item pai */
    .nav-item.menu-open > .nav-link {
        background-color: #007bff !important;
        color: #fff !important;
    }
    
    .nav-item.menu-open > .nav-link .nav-icon {
        color: #fff !important;
    }
    
    .nav-item.menu-open > .nav-link p {
        color: #fff !important;
        font-weight: bold;
    }
    
    /* Hover effect */
    .nav-link:hover:not(.active) {
        background-color: #f8f9fa !important;
        color: #495057 !important;
        border-radius: 5px;
        margin: 2px 0;
    }
    
    .nav-link:hover:not(.active) .nav-icon {
        color: #495057 !important;
    }
    
    
    
    /* Estado de carregamento para verificação de email */
    .is-loading {
        border-color: #ffc107 !important;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25) !important;
    }

    /* Melhorias para feedback de validação */
    .valid-feedback,
    .invalid-feedback {
        display: block;
        margin-top: 0.25rem;
        font-size: 0.875em;
    }

    .valid-feedback i,
    .invalid-feedback i {
        margin-right: 0.25rem;
    }
    
    /* Estilo para switch de status padrão */
    .custom-switch .custom-control-label::before {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .custom-switch .custom-control-input:checked ~ .custom-control-label::before {
        background-color: #28a745;
        border-color: #28a745;
    }
    
    .custom-switch .custom-control-label {
        font-weight: bold;
        color: #495057;
    }
</style>