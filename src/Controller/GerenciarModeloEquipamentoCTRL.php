<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\ModeloVO;
use Src\Model\ModeloEquipamentoMODEL;

class GerenciarModeloEquipamentoCTRL
{
    private $modeloEquipamentoModel;

    public function __construct()
    {
        $this->modeloEquipamentoModel = new ModeloEquipamentoMODEL();
    }

    public function GerenciarModeloEquipamento(ModeloVO $vo): string
    {
        if (empty($vo->getNome()))
            return 0;

        $vo->setErroTecnico(CADASTRAR_MODELO_EQUIPAMENTO);
        $vo->setCodLogado(Util::CodigoLogado());

        return $this->modeloEquipamentoModel->CadastrarModeloEquipamentoMODEL($vo);
    }

    public function AlterarModeloCTRL(ModeloVO $vo): string
    {
        if (empty($vo->getId()) || empty($vo->getNome())) {
            return 0;
        }

        $vo->setErroTecnico(ALTERAR_MODELO_EQUIPAMENTO);
        $vo->setCodLogado(Util::CodigoLogado());

        return $this->modeloEquipamentoModel->AlterarModeloEquipamentoMODEL($vo);
    }

    public function ExcluirModeloCTRL(ModeloVO $vo): string
    {
        if (empty($vo->getId())) {
            return 0;
        }

        $vo->setErroTecnico(EXCLUIR_MODELO_EQUIPAMENTO);
        $vo->setCodLogado(Util::CodigoLogado());

        return $this->modeloEquipamentoModel->ExcluirModeloEquipamentoMODEL($vo);
    }

    public function ConsultarModeloCTRL(): array
    {
        return $this->modeloEquipamentoModel->ConsultarModeloEquipamentoModel();
    }
    
}
