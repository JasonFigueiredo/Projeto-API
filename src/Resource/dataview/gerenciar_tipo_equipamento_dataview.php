<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Controller\GerenciarTipoEquipamentoCTRL;
use Src\VO\TipoVO;

$ctrl = new GerenciarTipoEquipamentoCTRL();

if (isset($_POST['btn_cadastrar'])) {
    $vo = new TipoVO();
    $vo->setNome($_POST['tipo']);
    $ret = $ctrl->CadastrarTipoEquipamentoCTRL($vo);

    if ($_POST['btn_cadastrar'] == 'ajx')
        echo $ret;
} else if (isset($_POST['btn_alterar'])) {
    $vo = new TipoVO();
    $vo->setNome($_POST['tipo_alterar']);
    $vo->setId($_POST['id_alterar']);
    $ret = $ctrl->AlterarTipoEquipamentoCTRL($vo);

    if ($_POST['btn_alterar'] == 'ajx')
        echo $ret;
} else if (isset($_POST['btn_excluir'])) {
    $vo = new TipoVO();
    $vo->setId($_POST['id_excluir']);
    $ret = $ctrl->ExcluirTipoEquipamentoCTRL($vo);

    if ($_POST['btn_excluir'] == 'ajx')
        echo $ret;
} else if (isset($_POST['consultar_tipo'])) {

    $tipos_equipamentos = $ctrl->ConsultarTipoEquipamentoCTRL(); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Ação</th>
                <th>Nome do Equipamento</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($tipos_equipamentos); $i++) { ?>
                <tr>
                    <td>
                        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#alterar-tipo" onclick="CarregarTipoEquipamento('<?= $tipos_equipamentos[$i]['id'] ?>','<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarExcluir('<?= $tipos_equipamentos[$i]['id'] ?>','<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Excluir</a>
                    </td>
                    <td>
                        <?= $tipos_equipamentos[$i]['nome_tipo'] ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>