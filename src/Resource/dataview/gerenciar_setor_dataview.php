<?php

use Src\Controller\SetorCTRL;
use Src\VO\SetorVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new SetorCTRL();

if (isset($_POST['consultar_setor'])) {
  $setores = $ctrl->ConsultarSetorCTRL();

?>
  <select class="form-control">
    <option value="">Selecione</option>
    <?php foreach ($setores as $item) { ?>
      <option value="<?= $item['id'] ?>"><?= $item['nome_setor'] ?></option>
    <?php } ?>
  </select>
<?php } ?>