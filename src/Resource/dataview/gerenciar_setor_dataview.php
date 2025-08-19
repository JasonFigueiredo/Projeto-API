<?php

use Src\Controller\SetorCTRL;
use Src\VO\SetorVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new SetorCTRL();
$ret = null;

if (isset($_POST['btn_cadastrar'])) {
  $vo = new SetorVO();
  $nome_setor = $_POST['nome_setor'] ?? '';
  $vo->setNome($nome_setor);
  $ret = $ctrl->CadastrarSetorCTRL($vo);
}

// Exclusão via AJAX
if (isset($_POST['btn_excluir']) && $_POST['btn_excluir'] == 'ajx') {
  $id = intval($_POST['id_excluir']);
  $ret = $ctrl->ExcluirSetorCTRL($id);
  echo $ret;
  exit;
}

// Alteração via AJAX
if (isset($_POST['btn_alterar']) && $_POST['btn_alterar'] == 'ajx') {
  $id = intval($_POST['id_alterar']);
  $nome = $_POST['nome_alterar'] ?? '';
  $ret = $ctrl->AlterarSetorCTRL($id, $nome);
  echo $ret;
  exit;
}

// Consultar setores via AJAX
if (isset($_POST['consultar_setor']) && $_POST['consultar_setor'] == 'ajx') {
  $setores = $ctrl->ConsultarSetorCTRL();
  ?>
  <?php foreach ($setores as $item) { ?>
    <tr>
      <td>
        <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-alterar" 
           onclick="AlterarSetor('<?= $item['id'] ?>','<?= $item['nome_setor'] ?>')">Alterar</a>
        <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" 
           onclick="ExcluirSetor('<?= $item['id'] ?>','<?= $item['nome_setor'] ?>')">Excluir</a>
      </td>
      <td><?=$item['nome_setor']?></td>
    </tr>
  <?php } ?>
  
  <?php
  exit;
}
$setores = $ctrl->ConsultarSetorCTRL();