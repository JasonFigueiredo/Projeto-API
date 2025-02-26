<?php

namespace Src\VO;

class ModeloVO
{
    private $nome_modelo;
    
    public function setIdModelo(string $nome_modelo): void
    {
        $this->nome_modelo = $nome_modelo;
    }
    public function getIdModelo(): string
    {
        return $this->nome_modelo;
    }
}