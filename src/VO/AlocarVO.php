<?php

namespace Src\VO;

use DateTime;
use Src\_Public\Util;

class AlocarVO
{
    private $id;
    private $equipamento_id;
    private $setor_id;


    public function setId(int $p_id): void
    {
        $this->id = Util::TratarDados($p_id);
    }
    public function getId(): int
    {
        return $this->id;
    }


    public function setEquipamentoId(int $p_equipamento_id): void
    {
        $this->equipamento_id = Util::TratarDados($p_equipamento_id);
    }
    public function getEquipamentoId(): int
    {
        return $this->equipamento_id;
    }


    public function setSetorId(int $p_setor_id): void
    {
        $this->setor_id = Util::TratarDados($p_setor_id);
    }
    public function getSetorId(): int
    {
        return $this->setor_id;
    }


    public function getDataAlocacar(): string
    {
        return Util::DataAtual();
    }
    public function setDataRemover(): string
    {
        return Util::DataAtual();
    }
}
