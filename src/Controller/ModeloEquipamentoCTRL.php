<?php

namespace Src\Controller;
use Src\VO\ModeloVO;

class ModeloEquipamentoCTRL
{

    public function CadastrarModelo(ModeloVO $vo): int
    {
        if(empty($vo->getNome())){
            return 0;
        }
        return 1;
    }
}
