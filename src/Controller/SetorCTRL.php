<?php


namespace Src\Controller;

use Src\VO\SetorVO;

class SetorCTRL
{

  public function CadastrarSetor(SetorVO $vo): int
  {
    if (empty($vo->getNome()))
      return 0;

    return 1;
  }
}
