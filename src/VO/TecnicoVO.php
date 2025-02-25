<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\UsuarioVO;

class TecnicoVO extends UsuarioVO
{
    private $nome_empresa;

    public function setNomeEmpresa($nome_empresa): void
    {
        $this->nome_empresa = Util::RemoverTags($nome_empresa);
    }
    public function getNomeEmpresa(): string
    {
        return $this->nome_empresa;
    }
}
