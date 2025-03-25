<?php

namespace Src\Controller;

use Src\VO\UsuarioVO;

class NovoUsuarioCTRL
{
  public function NovoUsuario(UsuarioVO $vo): int
  {
    if (
      empty($vo->getNome()) ||
      empty($vo->getTipo()) ||
      empty($vo->getEmail()) ||
      empty($vo->getTel()) ||
      empty($vo->getSenha()) ||
      empty($vo->getStatus())
    )
      return 0;
    return 1;
  }
}
