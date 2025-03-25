<?php

namespace Src\Controller;

use Src\VO\AlocarVO;

class AlocarEquipamentoCTRL
{

  public function AlocarEquipamento(AlocarVO $vo): string
  {
    if (
      empty($vo->getEquipamentoId()) ||
      empty($vo->getSetorId())
    ) {
      return 0;
    }
    return 1;
  }
}
