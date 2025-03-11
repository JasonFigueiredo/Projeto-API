<?php

namespace Src\VO;

use Src\_Public\Util;

class TipoVO
{
    private $id;
    private $nome_tipo;

    public function setNome(string $p_nome_tipo): void
    {
        $this->nome_tipo = Util::RemoverTags($p_nome_tipo);
    }
    public function getNome(): string
    {
        return $this->nome_tipo;
    }

    public function setId(int $p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

}
