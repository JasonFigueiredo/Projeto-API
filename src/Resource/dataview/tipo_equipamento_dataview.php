<?php

use Src\Controller\TipoEquipamentoCTRL;
use Src\VO\TipoVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new TipoVO();

    // Setar os valores inserido nos campos
    $vo->setNome($_POST["tipo"]);

    // Criar meu Controler
    $crtl = new TipoEquipamentoCTRL();

    // Chama a função de cadastro da Controler
    $ret = $crtl->CadastrarTipoEquipamentoCTRL($vo);
}
