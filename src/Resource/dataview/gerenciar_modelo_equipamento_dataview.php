<?php

use Src\Controller\GerenciarModeloEquipamentoCTRL;
use Src\VO\ModeloVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new ModeloVO();
    $ctrl = new GerenciarModeloEquipamentoCTRL();

    $vo->setNome($_POST["modelo"]);

    $ret = $ctrl->GerenciarModeloEquipamento($vo);
}
