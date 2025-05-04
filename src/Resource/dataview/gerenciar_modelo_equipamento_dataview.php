<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\VO\ModeloVO;
use Src\Controller\GerenciarModeloEquipamentoCTRL;
$ctrl = new GerenciarModeloEquipamentoCTRL();

if (isset($_POST["btn_cadastrar"])) {
    $vo = new ModeloVO();
    $vo->setNome($_POST["modelo"]);
    $ret = $ctrl->CadastrarModeloCTRL($vo);

    if ($_POST["btn_cadastrar"] == 'ajx')
        echo $ret;

} else if (isset($_POST["btn_alterar"])) {
    $vo = new ModeloVO();
    $vo->setNome($_POST["modelo_alterar"]);
    $vo->setId($_POST["id_alterar"]);

    $ret = $ctrl->AlterarModeloCTRL($vo);

    if ($_POST["btn_alterar"] == 'ajx')
        echo $ret;

} else if (isset($_POST["btn_excluir"])) {
    $vo = new ModeloVO();
    $vo->setId($_POST["id_excluir"]);
    $ret = $ctrl->ExcluirModeloCTRL($vo);

    if ($_POST["btn_excluir"] == 'ajx')
        echo $ret;

} else if (isset($_POST["btn_consultar"])) {
    $modelos = $ctrl->ConsultarModeloCTRL(); ?>
    <table class="table table-striped table-bordered table-hover" id="tabelaModeloEquipamento">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($modelos as $item) { ?>
                <tr>
                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAlterarModelo" onclick="carregarDadosModelo(<?php echo $item['id']; ?>, '<?php echo $item['nome_modelo']; ?>')">Alterar</button></td>
                    <td><?php echo $item["nome_modelo"]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    <?php } ?>