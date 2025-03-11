<?php

use Src\Controller\ModeloEquipamentoCTRL;
use Src\VO\ModeloVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST["btn_cadastrar"])) {
    
    // Criar meu VO
    $vo = new ModeloVO();
    $ctrl = new ModeloEquipamentoCTRL();

    // Setar os valores inserido nos campos
    $vo->setNome($_POST["modelo"]);

    // Chama a função de cadastro da Controler
    $ret = $ctrl->CadastrarModelo($vo);
}
?>