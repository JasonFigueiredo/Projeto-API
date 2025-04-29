<?php

namespace Src\VO;

use Src\_Public\Util;

class ModeloVO extends LogErroVO
{
    private $id;
    private $nome_modelo;

    // Setters e Getters do modelo 
    public function setNome(string $p_nome_modelo): void
    {
        $this->nome_modelo = Util::RemoverTags($p_nome_modelo);
    }
    public function getNome(): string
    {
        return $this->nome_modelo;
    }

    // Setters e Getters do id
    public function setid(int $p_id): void
    {
        $this->id = $p_id;
    }
    public function getid(): string
    {
        return $this->id;
    }
}
