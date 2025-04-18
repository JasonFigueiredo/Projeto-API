<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\UsuarioVO;

class FuncionarioVO extends UsuarioVO
{
    private $id_setor;

    public function setIdSetor(int $p_id_setor): void
    {
        $this->id_setor = Util::TratarDados($p_id_setor);
    }
    public function getIdSetor(): int
    {
        return $this->id_setor;
    }
}