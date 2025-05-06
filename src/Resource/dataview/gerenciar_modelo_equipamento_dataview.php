<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\GerenciarModeloEquipamentoCTRL;
use Src\VO\ModeloVO;

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
} else if (isset($_POST["btn_cadastrar"])) {
    $modelos = $ctrl->ConsultarModeloCTRL(); ?>
    <table class="table table-striped table-bordered table-hover" id="tabelaModeloEquipamento">
        <thead>
            <tr>
                <th>Modelo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($modelos); $i++) { ?>
                <tr>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" onclick="CarregarModeloEquipamento('<?= $modelos[$i]['id'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarExcluir('<?= $modelos[$i]['id'] ?>','<?= $modelos[$i]['nome_modelo'] ?>')">Excluir</a>
                    </td>
                    <td>
                        <?= $modelos[$i]['nome_modelo'] ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>