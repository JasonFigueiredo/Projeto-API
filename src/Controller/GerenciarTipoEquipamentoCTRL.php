<?php

namespace Src\Controller;

use Src\VO\TipoVO;
use Src\Model\TipoEquipamentoMODEL;

class GerenciarTipoEquipamentoCTRL
{

    private $model;

    public function __construct()
    {
        $this->model = new TipoEquipamentoMODEL();
    }

    public function CadastrarTipoEquipamentoCTRL(TipoVO $vo): int
    {
        if (empty($vo->getNome()))
            return 0;

        $ret = $this->model->CadastrarTipoEquipamentoMODEL($vo);

        return $ret;
    }
    public function ConsultarTipoEquipamentoCTRL()
    {
        return $this->model->ColsultarTipoEquipamentoMODEL();
    }
}
