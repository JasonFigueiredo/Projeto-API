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
} else if (isset($_POST["carregar_tipos"])) {
    $tipos = (new TipoEquipamentoCTRL)->ConsultarTipoEquipamentoCTRL();
?>

    <select name="tipo" id="tipo" class="form-control obg">
        <option value="">Selecione</option>
        <?php foreach ($tipos as $item) { ?>
            <option value="<? $item['id'] ?>"><? $item["nome_tipo"] ?></option>
        <?php } ?>

    </select>
<?php } else if (isset($_POST["carregar_modelos"])){
    $modelos = (new ModeloEquipamentoCTRL)->ConsultarModeloCTRL();
?>

    <select name="modelo" id="modelo" class="form-control obg">
        <option value="">Selecione</option>
        <?php foreach ($modelos as $item) { ?>
            <option value="<? $item['id'] ?>"><? $item["nome_modelo"] ?></option>
        <?php } ?>

    </select>

<?php } ?>
