<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\ModeloVO;
use Src\Model\ModeloEquipamentoMODEL;

class GerenciarModeloEquipamentoCTRL
{
    private $model;

    public function __construct()
    {
        $this->model = new ModeloEquipamentoMODEL();
    }

    public function CadastrarModeloCTRL(ModeloVO $vo): int
    {
        if (empty($vo->getNome()))
            return 0;

        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(CADASTRAR_MODELO_EQUIPAMENTO);

        return $this->model->CadastrarModeloEquipamentoMODEL($vo);
    }

    public function AlterarModeloCTRL(ModeloVO $vo): int
    {
        if (empty($vo->getNome()) || empty($vo->getId())) {
            return 0;
        }

        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(ALTERAR_MODELO_EQUIPAMENTO);

        return $this->model->AlterarModeloEquipamentoMODEL($vo);
    }

    public function ExcluirModeloCTRL(ModeloVO $vo): int
    {
        if (empty($vo->getId())) {
            return 0;
        }

        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(EXCLUIR_MODELO_EQUIPAMENTO);

        return $this->model->ExcluirModeloEquipamentoMODEL($vo);
    }

    public function ConsultarModeloCTRL()
    {
        return $this->model->ConsultarModeloEquipamentoModel();
    }
}
