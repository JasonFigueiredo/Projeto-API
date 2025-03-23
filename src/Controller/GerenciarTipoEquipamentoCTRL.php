<?php

namespace Src\Controller;
use Src\VO\TipoVO;

class GerenciarTipoEquipamentoCTRL
{

    public function GerenciarTipoEquipamento(TipoVO $vo): int
    {
        if(empty($vo->getNome())){
            return 0;
        }
        return 1;
    }
}
