<?php

use Src\Controller\GerenciarModeloEquipamentoCTRL;
use Src\VO\ModeloVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new ModeloVO();
    
    // Setar os valores inserido nos campos
    $vo->setNome($_POST["modelo"]);
    
    $ctrl = new GerenciarModeloEquipamentoCTRL();

    // Chama a função de cadastro da Controler
    $ret = $ctrl->GerenciarModeloEquipamento($vo);
}
