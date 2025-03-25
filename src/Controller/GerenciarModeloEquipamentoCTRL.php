<?php

namespace Src\Controller;
use Src\VO\ModeloVO;

class GerenciarModeloEquipamentoCTRL
{

    public function GerenciarModeloEquipamento(ModeloVO $vo): string
    {
        if(empty($vo->getNome())){
            return 0;
        }
        return 1;
    }
}
