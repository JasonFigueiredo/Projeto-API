<?php

use Src\_Public\Util;
use Src\Controller\NovoEquipamentoCTRL;
use Src\Controller\GerenciarTipoEquipamentoCTRL;
use Src\Controller\GerenciarModeloEquipamentoCTRL;
use Src\VO\EquipamentoVO;
use Src\VO\AlocarVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new NovoEquipamentoCTRL();

if (isset($_POST['btn_gravar']) && $_POST['btn_gravar'] == 'cadastrar') {

    $vo = new EquipamentoVO();

    // Defina os valores no VO
    $vo->setIdentificacao($_POST['identificacao']);
    $vo->setTipo(intval($_POST['tipo']));
    $vo->setModelo((int)($_POST['modelo']));
    $vo->setDescricao($_POST['descricao']);

    // Chame o método para cadastrar o novo equipamento
    $ret = $ctrl->NovoEquipamento($vo);

    if ($_POST['btn_gravar'] == 'cadastrar')
        echo $ret;
} else if (isset($_POST["carregar_tipos"])) {
    $tipos = (new GerenciarTipoEquipamentoCTRL)->ConsultarTipoEquipamentoCTRL();
    $tipo_id = isset($_POST['tipo_id']) ? $_POST['tipo_id'] : '';
?>

    <select name="tipo" id="tipo" class="form-control obg">
        <option value="">Selecione</option>
        <?php foreach ($tipos as $item) { ?>
            <option value="<?= $item['id'] ?>" <?= $tipo_id == $item['id'] ? 'selected' : '' ?>><?= $item["nome_tipo"] ?></option>
        <?php } ?>
    </select>

<?php } else if (isset($_POST["carregar_modelos"])) {
    $modelos = (new GerenciarModeloEquipamentoCTRL)->ConsultarModeloCTRL();
    $modelo_id = isset($_POST['modelo_id']) ? $_POST['modelo_id'] : '';
?>
    <select name="modelo" id="modelo" class="form-control obg">
        <option value="">Selecione</option>
        <?php foreach ($modelos as $item) { ?>
            <option value="<?= $item['id'] ?>" <?= $modelo_id == $item['id'] ? 'selected' : ''  ?>> <?= $item["nome_modelo"] ?></option>
        <?php } ?>
    </select>

<?php } else if (isset($_POST['filtrar_equipamentos'])) {

    $tipo = $_POST['tipo'];
    $modelo = $_POST['modelo'];

    $equipamentos = $ctrl->FiltrarEquipamentoCTRL($tipo, $modelo);


?>
    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Ações</th>
                <th>Nome do equipamento</th>
                <th>Modelo</th>
                <th>Identificação</th>
                <th>Descrição</th>
                <th>Situação</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($equipamentos as $item) { ?>
                <tr>
                    <td>
                        <a href="equipamento.php?id=<?= $item['equipamento_id'] ?>" class=" btn btn-success btn-xs">Alterar</a>
                        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarExcluir('<?= $item['equipamento_id'] ?>','<hr><b>Nome:</b> <?= $item['nome_tipo'] ?><br><b>Modelo:</b> <?= $item['nome_modelo'] ?><br><b>Identificação:</b> <?= $item['identificacao'] ?><br><b>Descrição:</b> <?= $item['descricao'] ?><hr>')">Excluir</a>
                        <?php if ($item['esta_alocado'] == 0 && $item['situacao'] != SITUACAO_DESCARTADO) { ?>
                            <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-descarte" onclick="CarregarDescarte('<?= $item['equipamento_id'] ?>','<hr><b>Nome:</b> <?= $item['nome_tipo'] ?><br><b>Modelo:</b> <?= $item['nome_modelo'] ?><br><b>Identificação:</b> <?= $item['identificacao'] ?><br><b>Descrição:</b> <?= $item['descricao'] ?><hr>')">Descarte</a>
                        <?php } else if ($item['situacao'] == SITUACAO_DESCARTADO) { ?>
                            <a href="#" class="btn btn-secondary btn-xs" data-toggle="modal" data-target="#modal-descarteinfo" onclick="CarregarDescarteInfo('<?= $item['data_descarte'] ?>','<hr><b>Nome:</b> <?= $item['nome_tipo'] ?><br><b>Modelo:</b> <?= $item['nome_modelo'] ?><br><b>Identificação:</b> <?= $item['identificacao'] ?><br><b>Descrição:</b> <?= $item['descricao'] ?><br><b>Motivo descarte:</b> <?= $item['motivo_descarte'] ?><hr>')">Dados descarte</a>
                        <?php } ?>
                    </td>
                    <td><?= $item['nome_tipo'] ?></td>
                    <td><?= $item['nome_modelo'] ?></td>
                    <td><?= $item['identificacao'] ?></td>
                    <td><?= $item['descricao'] ?></td>
                    <td><?= Util::MostrarSituacao($item['situacao']) ?></td>
                </tr>
        </tbody>
    <?php } ?>
    </table>
<?php } else if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $equipamento = $ctrl->DetalharEquipamentoCTRL($_GET['id']);

    if (empty($equipamento))
        Util::ChamarPagina('consultar_equipamento');
} else if (isset($_POST['btn_gravar']) && $_POST['btn_gravar'] == 'alterar') {

    $vo = new EquipamentoVO();

    $vo->setId($_POST['id_equipamento']);
    $vo->setIdentificacao($_POST['identificacao']);
    $vo->setTipo((intval($_POST['tipo'])));
    $vo->setModelo((int)$_POST['modelo']);
    $vo->setDescricao($_POST['descricao']);

    // Chame o método para alterar o equipamento
    $ret = $ctrl->AlterarEquipamentoCTRL($vo);

    if ($_POST['btn_gravar'] == 'alterar')
        echo $ret;
} else if (isset($_POST['btn_excluir'])) {

    $vo = new EquipamentoVO();
    $vo->setId($_POST['id_equipamento']);

    $ret = $ctrl->ExcluirEquipamentoCTRL($vo);
    echo $ret;
} else if (isset($_POST['btn_descarte'])) {
    $vo = new EquipamentoVO();
    $vo->setId($_POST['id_equipamento']);
    $vo->setMotivoDescarte($_POST['motivo_descarte']);
    $vo->setDataDescarte(($_POST['data_descarte']));
    $ret = $ctrl->DescartarEquipamentoCTRL($vo);
    echo $ret;
} else if (isset($_POST['carregar_equipamentos_nao_alocados'])) {
    $equipamentos = $ctrl->SelecionarEquipamentoNaoAlocadosCTRL();
?>
    <select class="form-control obg">
        <option value="">Selecione</option>
        <?php foreach ($equipamentos as $item) { ?>
            <option value="<?= $item['equipamento_id'] ?>"> <?= 'Identificação: ' . $item["identificacao"] . ' / ' . $item["nome_tipo"] . ' / ' . $item["nome_modelo"] ?></option>
        <?php } ?>
    </select>
<?php } else if (isset($_POST['alocar_equipamento'])) {

    $vo = new AlocarVO();
    $vo->setEquipamentoId($_POST['id_equipamento']);
    $vo->setSetorId($_POST['id_setor']);

    $ret = $ctrl->AlocarEquipamentoCTRL($vo);
    echo $ret;
}