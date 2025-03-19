<?php

namespace Src\Controller;

use Src\VO\EquipamentoVO;

class ModeloEquipamentoCTRL
{
  public function CadastrarEquipamento(EquipamentoVO $vo): int
  {
    if (
      !empty($vo->getTipoId()) || empty($vo->getModeloId()) || empty($vo->getIdentificacao())
      || empty($vo->getDescricao())
    ) {
      return 0;
    }
  }
}
