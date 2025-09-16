<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\UsuarioVO;

class TecnicoVO extends UsuarioVO
{
    private $nome_empresa;

    public function setNomeEmpresa(string $p_nome): void
    {
        $this->nome_empresa = Util::TratarDados($p_nome);
    }
    public function getNomeEmpresa(): string
    {
        return $this->nome_empresa;
    }
}