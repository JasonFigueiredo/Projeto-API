<?php

namespace Src\Controller;

use Src\VO\TipoVO;
use Src\Model\TipoEquipamentoMODEL;

class GerenciarTipoEquipamentoCTRL
{

    public function CadastrarTipoEquipamento(TipoVO $vo): int
    {
        if (empty($vo->getNome()))
            return 0;

        $model = new TipoEquipamentoMODEL();

        $ret = $model->CadastrarTipoEquipamento($vo);

        return $ret;
    }
}
