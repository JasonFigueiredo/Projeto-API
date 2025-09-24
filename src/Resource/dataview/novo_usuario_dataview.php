<?php

use Src\_Public\Util;
use Src\Controller\UsuarioCTRL;
use Src\VO\UsuarioVO;
use Src\VO\FuncionarioVO;
use Src\VO\TecnicoVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['verificar_email_duplicado'])) {
  $emailDuplicado = $ctrl->verificarEmailDuplicadoCTRL($_POST['email']);
  echo $emailDuplicado ? 'true' : 'false';
  exit;
} else if (isset($_POST['verificar_cpf_duplicado'])) {
  $cpfDuplicado = $ctrl->verificarCpfDuplicadoCTRL($_POST['cpf']);
  echo $cpfDuplicado ? 'true' : 'false';
  exit;
} else if (isset($_POST['btn_cadastrar'])) {

  switch ($_POST['tipo']) {
    case USUARIO_ADM:
      $vo = new UsuarioVO();
      //DADOS DO USUARIO/ADM
      break;

    case USUARIO_TECNICO:
      $vo = new TecnicoVO();
      //DADOS DO TECNICO
      $vo->setNomeEmpresa($_POST['empresa']);
      break;

    case USUARIO_FUNCIONARIO:
      $vo = new FuncionarioVO();
      //DADOS DO FUNCIONARIO
      $vo->setIdSetor($_POST['setor']);
      break;
  }
  //DADOS COMUNS A TODOS OS PERFIS
  $vo->setTipo($_POST['tipo']);
  $vo->setNome($_POST['nome']);
  $vo->setEmail($_POST['email']);
  $vo->setCPF($_POST['cpf']);
  $vo->setTel($_POST['tel']);

  //dados do endereço
  $vo->setRua($_POST['rua']);
  $vo->setBairro($_POST['bairro']);
  $vo->setCep($_POST['cep']);
  $vo->setCidade($_POST['cidade']);
  $vo->setEstado($_POST['estado']);

  $ret = $ctrl->cadastrarUsuarioCTRL($vo);
  echo $ret;
} else if (isset($_POST['filtrar_usuario'])) {
  $usuarios_encontrados = $ctrl->filtrarUsuarioCTRL($_POST['nome_filtro']);

  if (count($usuarios_encontrados) == 0)
    echo 0;
  else {
?>

    <table id="tableResult" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Ação</th>
          <th>Situação</th>
          <th>Nome do usuario</th>
          <th>Tipo de usuario</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($usuarios_encontrados as $item) {
        ?>
          <tr>
            <td>
              <a href="#" class="btn btn-warning btn-xs" onclick="DetalharUsuario(<?= $item['id'] ?>)">Alterar</a>
            </td>
            <td>
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="switch_<?= $item['id'] ?>" <?= $item['status_usuario'] == SITUACAO_ATIVO ? 'checked' : '' ?>
                  onchange="AlterarStatusUsuario(<?= $item['id'] ?>, this.checked ? <?= SITUACAO_ATIVO ?> : <?= SITUACAO_INATIVO ?>)">
                <label class="custom-control-label" for="switch_<?= $item['id'] ?>">
                  <?= $item['status_usuario'] == SITUACAO_ATIVO ? 'ATIVO' : 'INATIVO' ?>
                </label>
              </div>
            </td>
            <td><?= $item['nome_usuario'] ?></td>
            <td><?= Util::MostrarTipoUsuario($item['tipo_usuario']) ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
<?php }
} else if (isset($_POST['alterar_status_usuario'])) {
  $vo = new UsuarioVO();
  $vo->setId($_POST['id_usuario']);
  $vo->setStatus($_POST['status_usuario']);
  echo $ret = $ctrl->AlterarStatusUsuarioCTRL($vo);
  exit;
} else if (isset($_POST['btn_alterar']) && $_POST['btn_alterar'] == 'ajx') {
  // Lógica para alterar usuário
  $id_usuario = $_POST['id_usuario'] ?? '';
  $tipo = $_POST['tipo'] ?? '';

  // Validar se ID do usuário foi enviado
  if (empty($id_usuario) || !is_numeric($id_usuario)) {
    echo 0; // ID inválido
    exit;
  }

  // Criar VO baseado no tipo
  switch ($tipo) {
    case USUARIO_ADM:
      $vo = new UsuarioVO();
      break;
    case USUARIO_FUNCIONARIO:
      $vo = new FuncionarioVO();
      $setor = $_POST['setor'] ?? '';
      if (!empty($setor)) {
        $vo->setIdSetor(intval($setor));
      }
      break;
    case USUARIO_TECNICO:
      $vo = new TecnicoVO();
      $empresa = $_POST['empresa'] ?? '';
      if (!empty($empresa)) {
        $vo->setNomeEmpresa($empresa);
      }
      break;
    default:
      echo 0;
      exit;
  }

  // Preencher dados comuns
  $vo->setId(intval($id_usuario));
  $vo->setNome($_POST['nome']);
  $vo->setEmail($_POST['email']);
  $vo->setCpf($_POST['cpf']);
  $vo->setTel($_POST['tel']);
  $vo->setTipo(intval($tipo));

  // Dados de endereço (UsuarioVO herda de EnderecoVO)
  $vo->setCep($_POST['cep']);
  $vo->setRua($_POST['rua']);
  $vo->setBairro($_POST['bairro']);
  $vo->setCidade($_POST['cidade']);
  $vo->setEstado($_POST['estado']);

  // Chamar método de alteração no controller
  echo $ret = $ctrl->AlterarUsuarioCTRL($vo);
  exit;
} else if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

  $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);

  if (!is_array($dados) || empty($dados))
    Util::ChamarPagina('consultar_usuario');
} 

 else if (isset($_POST['btn_logar'])) {
  $login = $_POST['login_usuario'];
  $senha = $_POST['senha_usuario'];
  
  $ret = $ctrl->ValidarLoginCTRL($login, $senha);
  echo $ret;

} ?>