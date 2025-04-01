<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\GerenciarTipoEquipamentoCTRL;
use Src\VO\TipoVO;

$crtl = new GerenciarTipoEquipamentoCTRL();


if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new TipoVO();
    
    // Setar os valores inserido nos campos
    $vo->setNome($_POST["tipo"]);
    
    // Chama a função de cadastro da Controler
    $ret = $crtl->CadastrarTipoEquipamentoCTRL($vo);
}
$tipos_equipamentos = $ctrl->ConsultarTipoEquipamentoCTRL();