<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\EquipamentoVO;
use Src\VO\AlocarVO;
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
    $vo->setFuncaoErro(CADASTRAR_EQUIPAMENTO);
    $vo->setCodLogado(Util::CodigoLogado());

    return $this->model->NovoEquipamentoModel($vo);
  }

  public function AlterarEquipamentoCTRL(EquipamentoVO $vo): int
  {
    if (
      empty($vo->getTipo()) ||
      empty($vo->getModelo()) ||
      empty($vo->getIdentificacao()) ||
      empty($vo->getDescricao()) ||
      empty($vo->getId())
    )
      return 0;

    $vo->setFuncaoErro(ALTERAR_EQUIPAMENTO);
    $vo->setCodLogado(Util::CodigoLogado());

    return $this->model->AlterarEquipamentoModel($vo);
  }

  public function FiltrarEquipamentoCTRL($tipo, $modelo): array
  {
    return $this->model->FiltrarEquipamentoModel($tipo, $modelo, SITUACAO_EQUIPAMENTO_REMOVIDO);
  }

  public function DetalharEquipamentoCTRL(int $id): array | String
  {
    return $this->model->DetalharEquipamentoModel($id);
  }


  public function ExcluirEquipamentoCTRL(EquipamentoVO $vo): int
  {
    if (empty($vo->getId()))
      return 0;

    $vo->setCodLogado(Util::CodigoLogado());
    $vo->setFuncaoErro(EXCLUIR_EQUIPAMENTO);

    return $this->model->ExcluirEquipamentoModel($vo);
  }

  public function DescartarEquipamentoCTRL(EquipamentoVO $vo): int
  {
    if (
      empty($vo->getId()) ||
      empty($vo->getMotivoDescarte()) ||
      empty($vo->getDataDescarte())
    )
      return 0;

    $vo->setCodLogado(Util::CodigoLogado());
    $vo->setSituacao(SITUACAO_DESCARTADO);
    $vo->setFuncaoErro(DESCARTAR_EQUIPAMENTO);

    return $this->model->DescartarEquipamentoModel($vo);
  }

  public function SelecionarEquipamentoNaoAlocadosCTRL(): array | null
  {
    return $this->model->SelecionarEquipamentoNaoAlocadosMODEL(SITUACAO_ATIVO, SITUACAO_EQUIPAMENTO_REMOVIDO);
  }

  public function AlocarEquipamentoCTRL(AlocarVO $vo): int
  {
    if (
      empty($vo->getEquipamentoId()) ||
      empty($vo->getSetorId())
    )
      return 0;
    $vo->setSituacao(SITUACAO_EQUIPAMENTO_ALOCADO);
    $vo->setFuncaoErro(ALOCAR_EQUIPAMENTO);
    $vo->setCodLogado(Util::CodigoLogado());

    return $this->model->AlocarEquipamentoModel($vo);
  }
}
