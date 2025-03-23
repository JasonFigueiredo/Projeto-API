<?php

use Src\Controller\NovoEquipamentoCTRL;
use Src\VO\EquipamentoVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST['btn_cadastrar'])) {

    $vo = new EquipamentoVO();
    $ctrl = new NovoEquipamentoCTRL();

    // Defina os valores no VO
    $vo->setIdentificacao($_POST['identificacao']);
    $vo->setTipoId((int)$_POST['tipo']);
    $vo->setModeloId((int)$_POST['modelo']);
    $vo->setDescricao($_POST['descricao']);

    // Chame o método para cadastrar o novo equipamento
    $ret = $ctrl->NovoEquipamento($vo);
}