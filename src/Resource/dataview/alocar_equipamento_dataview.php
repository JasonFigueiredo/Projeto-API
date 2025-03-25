<?php

use Src\Controller\AlocarEquipamentoCTRL;
use Src\VO\AlocarVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if(isset($_POST['btn_alocar'])){

    $vo = new AlocarVO();
    $ctrl = new AlocarEquipamentoCTRL();

    // Defina os valores no VO
    $vo->setEquipamentoId($_POST['tipo']);
    $vo->setSetorId($_POST['setor']);

    // Chame o método para alocar o equipamento
    $ret = $ctrl->AlocarEquipamento($vo);
}