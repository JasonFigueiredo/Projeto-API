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
        // Validar nome usando Util
        if (!Util::ValidarNome($vo->getNome(), 2))
            return 0;

        // Tratar e definir nome limpo no VO
        $vo->setNome(Util::TratarDados($vo->getNome()));

        // Definir dados de log usando Util
        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(CADASTRAR_SETOR);

        return $this->model->CadastrarSetorMODEL($vo);
    }
    public function ConsultarSetorCTRL()
    {
        return $this->model->ConsultarSetorMODEL();
    }

    public function ExcluirSetorCTRL(int $id)
    {
        // Validação: Verificar se ID é válido
        if($id <= 0) 
            return 0;

        // Criar VO com ID
        $vo = new SetorVO();
        $vo->setId($id);
        
        // Definir dados de log para rastreabilidade
        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(EXCLUIR_SETOR);

        return $this->model->ExcluirSetorMODEL($vo);
    }
}