<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\TipoVO;
use Src\Model\TipoEquipamentoMODEL;

class GerenciarTipoEquipamentoCTRL
{

    private $model;

    public function __construct()
    {
        $this->model = new TipoEquipamentoMODEL();
    }


    /// Método para cadastrar um tipo de equipamento
    public function CadastrarTipoEquipamentoCTRL(TipoVO $vo): int
    {
        if (empty($vo->getNome()))
            return 0;
        
        $vo->setCodLogado(Util::CodigoLogado());
        $vo->setFuncaoErro(CADASTRAR_TIPO_EQUIPAMENTO);

        return $this->model->CadastrarTipoEquipamentoMODEL($vo);
    }


    /// Método para consultar todos os tipos de equipamentos
    public function ConsultarTipoEquipamentoCTRL()
    {
        return $this->model->ColsultarTipoEquipamentoMODEL();
    }


    /// Método para Alterar um tipo de equipamento
    public function AlterarTipoEquipamentoCTRL(TipoVO $vo): int
    {
        if (empty($vo->getNome()) || empty($vo->getId()))
            return 0;

        $ret = $this->model->AlterarTipoEquipamentoMODEL($vo);

        return $ret;
    }

    /// Método para excluir um tipo de equipamento
    public function ExcluirTipoEquipamentoCTRL(TipoVO $vo): int
    {
        if (empty($vo->getId()))
            return 0;

        $ret = $this->model->ExcluirTipoEquipamentoMODEL($vo);

        return $ret;
    }

}
