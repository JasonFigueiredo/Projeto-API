<?php

use Src\Controller\NovoUsuarioCTRL;
use Src\VO\UsuarioVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST['btn_cadastrar'])) {

  $vo = new UsuarioVO();
  $ctrl = new NovoUsuarioCTRL();

  // Defina os valores no VO
  $vo->setNome($_POST['nome']);
  $vo->setTipo($_POST['tipo']);
  $vo->setEmail($_POST['email']);
  $vo->setTel($_POST['tel']);
  $vo->setSenha($_POST['senha']);

  // Chame o método para cadastrar o novo usuario
  $ret = $ctrl->NovoUsuario($vo);
}
?>