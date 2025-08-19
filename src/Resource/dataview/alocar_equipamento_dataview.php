<?php

use Src\Controller\NovoEquipamentoCTRL;
use Src\VO\AlocarVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new NovoEquipamentoCTRL();
$ret = null;

// Handler para formulário tradicional (se usado)
if(isset($_POST['btn_alocar'])){
    $vo = new AlocarVO();
    
    // Usar os nomes corretos do formulário
    $vo->setEquipamentoId($_POST['equipamento']);
    $vo->setSetorId($_POST['setor']);
    
    $ret = $ctrl->AlocarEquipamentoCTRL($vo);
}

// Handler para AJAX (usado pela função AlocarEquipamento)
if(isset($_POST['alocar_equipamento']) && $_POST['alocar_equipamento'] == 'ajx'){
    $vo = new AlocarVO();
    
    // Usar os IDs enviados pelo AJAX
    $vo->setEquipamentoId($_POST['id_equipamento']);
    $vo->setSetorId($_POST['id_setor']);
    
    $ret = $ctrl->AlocarEquipamentoCTRL($vo);
    echo $ret;
    exit;
}