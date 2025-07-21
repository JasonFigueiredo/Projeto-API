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

    // /// Método para cadastrar um setor
    // public function CadastrarSetorCTRL(SetorVO $vo): int
    // {
    //     if (empty($vo->getNome()))
    //         return 0;

    //     $vo->setCodLogado(Util::CodigoLogado());
    //     $vo->setFuncaoErro(CADASTRAR_TIPO_EQUIPAMENTO);

    //     return $this->model->CadastrarTipoEquipamentoMODEL($vo);
    // }


    /// Método para consultar todos os tipos de equipamentos
    public function ConsultarSetorCTRL()
    {
        return $this->model->ConsultarSetorModel();
    }


    // /// Método para Alterar um setor
    // public function AlterarSetorCTRL(SetorVO $vo): int
    // {
    //     if (empty($vo->getNome()) || empty($vo->getId()))
    //         return 0;

    //     $ret = $this->model->AlterarSetorMODEL($vo);

    //     return $ret;
    // }

    // /// Método para excluir um setor
    // public function ExcluirSetorCTRL(SetorVO $vo): int
    // {
    //     if (empty($vo->getId()))
    //         return 0;

    //     $ret = $this->model->ExcluirSetorMODEL($vo);

    //     return $ret;
    // }
}
