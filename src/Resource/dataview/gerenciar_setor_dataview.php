<?php

use Src\Controller\GerenciarSetorCTRL;
use Src\VO\SetorVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST['btn_cadastrar'])) {

  $vo = new SetorVO();
  $ctrl = new GerenciarSetorCTRL();

  $vo->setNome($_POST['nome']);

  $ret = $ctrl->GerenciarSetor($vo);
}
