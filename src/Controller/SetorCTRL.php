<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\SetorVO;
use Src\Model\SetorMODEL;

class SetorCTRL
{
    private $model;

    public function __construct()
    {
        $this->model = new SetorMODEL();
    }

    public function CadastrarSetorCTRL(SetorVO $vo)
    {
        if(empty($vo->getNome())) 
            return 0;

        return $this->model->CadastrarSetorMODEL($vo);
    }
    public function ConsultarSetorCTRL()
    {
        return $this->model->ConsultarSetorMODEL();
    }

    public function ExcluirSetorCTRL(int $id)
    {
        if($id <= 0) 
            return 0;

        $vo = new SetorVO();
        $vo->setId($id);
        return $this->model->ExcluirSetorMODEL($vo);
    }
}