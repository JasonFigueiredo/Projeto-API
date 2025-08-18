<?php

use Src\Controller\SetorCTRL;
use Src\VO\SetorVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new SetorCTRL();
$ret = null;

if (isset($_POST['btn_cadastrar'])) {
  $vo = new SetorVO();
  $nome_setor = $_POST['nome_setor'] ?? '';
  $vo->setNome($nome_setor);
  $ret = $ctrl->CadastrarSetorCTRL($vo);
}

$setores = $ctrl->ConsultarSetorCTRL();
?>

