<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\EquipamentoCTRL;
use Src\VO\EquipamentoVO;

if(isset($_POST['btn_cadastrar'])){

  $vo = new EquipamentoVO();
  $ctrl = new EquipamentoCTRL();

  $vo->setIdentificacao($_POST['identificacao']);
  $vo->setDescricao($_POST['descricao']);
  $vo->setTipoId($_POST['tipo']);
  $vo->setModeloId($_POST['modelo']);

  $ret = $ctrl->CadastrarEquipamento($vo);
}

?>