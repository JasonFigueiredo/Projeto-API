<?php

namespace Src\Controller;

use Src\VO\EquipamentoVO;

class NovoEquipamentoCTRL
{
  public function NovoEquipamento(EquipamentoVO $vo):int
  {
    if (
      empty($vo->getIdentificacao()) ||
      empty($vo->getTipoId()) ||
      empty($vo->getModeloId()) ||
      empty($vo->getDescricao())
    )
      return 0;
      return 1;
  }
}
