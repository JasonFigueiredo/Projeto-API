<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\EquipamentoVO;
use Src\Model\NovoEquipamentoMODEL;

class NovoEquipamentoCTRL
{
  private $model;

  public function __construct()
  {
    $this->model = new NovoEquipamentoMODEL();
  }

  public function NovoEquipamento(EquipamentoVO $vo): int
  {
    if (
      empty($vo->getTipo()) ||
      empty($vo->getModelo()) ||
      empty($vo->getIdentificacao()) ||
      empty($vo->getDescricao())
    )
      return 0;

    $vo->setSituacao(SITUACAO_ATIVO);
    $vo->setFuncaoErro(CADASTRAR_NOVO_EQUIPAMENTO);
    $vo->setCodLogado(Util::CodigoLogado());

    return $this->model->NovoEquipamentoModel($vo);
  }

  public function FiltrarEquipamentoCTRL($tipo, $modelo): array
  {
    return $this->model->FiltrarEquipamentoModel($tipo, $modelo);
  }
}
