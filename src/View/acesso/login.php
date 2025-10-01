<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/novo_usuario_dataview.php';
?>

<!DOCTYPE html>
<html>

<head>
  <?php
  include_once PATH . "Template/_includes/_head.php";
  ?>
  <!-- CSS personalizado para login -->
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a><b>Controle de Chamados</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Entre para iniciar sua sessão</p>

        <form id="formLOG" method="post">
          <div class="input-group mb-3">
            <input id="login" name="login" type="text" class="form-control obg" placeholder="CPF *" maxlength="14" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="senha" name="senha" type="password" class="form-control obg" placeholder="Senha *" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div style="text-align: left;">
                <button type="submit" name="btn_logar" class="btn btn-primary" onclick="Logar('formLOG'); return false;">Entrar</button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <?php
  include_once PATH . "Template/_includes/_scripts.php";
  include_once PATH . "Template/_includes/_msg.php";
  ?>
  <script src="../../Resource/ajax/usuario_ajax.js"></script>
  <!-- Validação de CPF comentada para evitar conflitos no login -->
  <!-- <script src="../../Resource/js/validar_cpf.js"></script> -->
  
  <script>
  // Aplicar máscara de CPF no campo de login
  $(document).ready(function () {
    $('#login').on('input', function() {
      let cpf = $(this).val().replace(/\D/g, '');
      if (cpf.length > 11) cpf = cpf.substring(0, 11);
      
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
      cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
      cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
      
      $(this).val(cpf);
    });
  });
  </script>

</body>

</html>