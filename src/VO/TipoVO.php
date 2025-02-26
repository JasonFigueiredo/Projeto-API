<?php

namespace Src\VO;

class TipoVO
{
    private $nome_tipo;

    public function setIdTipo(string $nome_tipo): void
    {
        $this->nome_tipo = $nome_tipo;
    }
    public function getIdTipo(): string
    {
        return $this->nome_tipo;
    }
}
