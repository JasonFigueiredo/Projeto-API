<?php


namespace Src\Controller;

use Src\VO\SetorVO;

class GerenciarSetorCTRL
{

  public function GerenciarSetor(SetorVO $vo): int
  {
    if (empty($vo->getNome()))
      return 0;

    return 1;
  }
}
