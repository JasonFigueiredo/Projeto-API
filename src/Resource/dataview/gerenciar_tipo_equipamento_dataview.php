<?php

use Src\Controller\GerenciarTipoEquipamentoCTRL;
use Src\VO\TipoVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new TipoVO();

    // Setar os valores inserido nos campos
    $vo->setNome($_POST["tipo"]);

    // Criar meu Controler
    $crtl = new GerenciarTipoEquipamentoCTRL();

    // Chama a função de cadastro da Controler
    $ret = $crtl->GerenciarTipoEquipamento($vo);
}
