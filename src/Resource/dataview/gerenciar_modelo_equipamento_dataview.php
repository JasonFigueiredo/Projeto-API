<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\GerenciarModeloEquipamentoCTRL;
use Src\VO\ModeloVO;


if (isset($_POST["btn_cadastrar"])) {
    // Criar meu VO
    $vo = new ModeloVO();
    $ctrl = new GerenciarModeloEquipamentoCTRL();

    $vo->setNome($_POST["modelo"]);

    $ret = $ctrl->GerenciarModeloEquipamento($vo);

    if ($_POST["btn_cadastrar"] == 'ajx')
        echo $ret;
} else if (isset($_POST["btn_alterar"])) {
    // Criar meu VO
    $vo = new ModeloVO();
    $ctrl = new GerenciarModeloEquipamentoCTRL();

    $vo->setNome($_POST["modelo_alterar"]);
    $vo->setId($_POST["id_alterar"]);

    $ret = $ctrl->AlterarModeloCTRL($vo);

    if ($_POST["btn_alterar"] == 'ajx')
        echo $ret;
} else if (isset($_POST["btn_excluir"])) {
    $vo = new ModeloVO();
    $ctrl = new GerenciarModeloEquipamentoCTRL();

    $vo->setId($_POST["id"]);

    $ret = $ctrl->ExcluirModeloCTRL($vo);

    if ($_POST["btn_excluir"] == 'ajx')
        echo $ret;
} else if (isset($_POST["btn_consultar"])) {
    $moelos = $ctrl->ConsultarModeloCTRL(); ?>
    <table class="table table-striped table-bordered table-hover" id="tabelaModeloEquipamento">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($moelos as $item) { ?>
                <tr>
                    <td><?php echo $item["nome_modelo"]; ?></td>
                    <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAlterarModelo" onclick="carregarDadosModelo(<?php echo $item['id']; ?>, '<?php echo $item['nome_modelo']; ?>')">Alterar</button></td>
                </tr>
            <?php } ?>
        </tbody>
    <?php } ?>