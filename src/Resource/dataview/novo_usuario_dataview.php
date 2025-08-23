<?php

use Src\Controller\UsuarioCTRL;
use Src\VO\UsuarioVO;
use Src\VO\FuncionarioVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['verificar_email_duplicado'])) {
  $emailDuplicado = $ctrl->verificarEmailDuplicadoCTRL($_POST['email']);
  echo $emailDuplicado ? 'true' : 'false';
  exit;
} else if (isset($_POST['btn_cadastrar'])) {
  switch ($_POST['tipo']) {
    case USUARIO_ADM:
      $vo = new UsuarioVO();
      //DADOS DO USUARIO/ADM
      break;

    case USUARIO_TECNICO:
      $vo = new FuncionarioVO();
      // O perfil do tecnico esta dentro de FuncionarioVO
      //DADOS DO TECNICO
      $vo->setNomeEmpresa($_POST['nome_empresa']);
      break;

    case USUARIO_FUNCIONARIO:
      $vo = new FuncionarioVO();
      //DADOS DO FUNCIONARIO
      $vo->setIdSetor($_POST['id_setor']);
      break;
  }
  //DADOS COMUNS A TODOS OS PERFIS
  $vo->setTipo($_POST['tipo']);
  $vo->setNome($_POST['nome']);
  $vo->setEmail($_POST['email']);
  $vo->setCPF($_POST['cpf']);
  $vo->setTel($_POST['telefone']);

  //dados do endereço
  $vo->setRua($_POST['rua']);
  $vo->setBairro($_POST['bairro']);
  $vo->setCep($_POST['cep']);
  $vo->setCidade($_POST['cidade']);
  $vo->setEstado($_POST['estado']);

  $ret = $ctrl->cadastrarUsuarioCTRL($vo);
  echo $ret;
}
