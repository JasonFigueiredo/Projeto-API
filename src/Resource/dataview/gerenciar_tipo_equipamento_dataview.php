<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\GerenciarTipoEquipamentoCTRL;
use Src\VO\TipoVO;

$ctrl = new GerenciarTipoEquipamentoCTRL();



if (isset($_POST['btn_cadastrar'])) {
    // Criar meu VO
    $vo = new TipoVO();
    // Setar os valores inserido nos campos
    $vo->setNome($_POST['tipo']);
    // Chama a função de cadastro da Controler
    $ret = $ctrl->CadastrarTipoEquipamentoCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx')
        echo $ret;
} else if (isset($_POST['btn_alterar'])) {
    $vo = new TipoVO();
    $vo->setNome($_POST['tipo_alterar']);
    $vo->setId($_POST['id_alterar']);
    $ret = $ctrl->AlterarTipoEquipamentoCTRL($vo);
} else if (isset($_POST['btn_excluir'])) {
    $vo = new TipoVO();
    $vo->setId($_POST['id_excluir']);
    $ret = $ctrl->ExcluirTipoEquipamentoCTRL($vo);
}

//atualiza a lista de tipos de equipamentos
$tipos_equipamentos = $ctrl->ConsultarTipoEquipamentoCTRL();
