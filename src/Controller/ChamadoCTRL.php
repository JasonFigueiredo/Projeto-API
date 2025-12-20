<?php

namespace Src\Controller;

use Src\_Public\Util;
use Src\VO\ChamadoVO;
use Src\Model\ChamadoMODEL;

class ChamadoCTRL
{

   private $model;

   public function __construct()
   {
      $this->model = new ChamadoMODEL();
   }

   public function AbrirChamadoCTRL(ChamadoVO $vo, $tem_sessao = true): int
   {
      if (empty($vo->getProblema()) || empty($vo->getIdAlocar()))
         return 0;

      // Preencher data e hora de abertura
      $vo->setDataAbertura(Util::DataAtual());
      $vo->setHoraAbertura(Util::HoraAtual());

      $vo->setFuncaoErro(ABRIR_CHAMADO);
      $vo->setCodLogado($tem_sessao ? Util::CodigoLogado() : $vo->getIdFuncionario());
      $vo->setSituacao(SITUACAO_EQUIPAMENTO_MANUTENCAO);
      return $this->model->AbrirChamadoModel($vo);
   }

   public function FiltrarChamadosCTRL(int $situacao, int $setor_id): array|null
   {
      return $this->model->FiltrarChamadoModel($situacao, $setor_id);
   }

   public function AtenderChamadoCTRL(ChamadoVO $vo): int
   {
      if (empty($vo->getIdTecnicoAtendimento()) || empty($vo->getId()))
         return 0;

      $vo->setDataAtendimento(Util::DataAtual());
      $vo->setHoraAtendimento(Util::HoraAtual());
      $vo->setFuncaoErro(ATENDER_CHAMADO);
      $vo->setCodLogado($vo->getIdTecnicoAtendimento());
      return $this->model->AtenderChamadoModel($vo);
   }

   public function FinalizarChamadoCTRL(ChamadoVO $vo): int
   {
      if (empty($vo->getTecnicoEncerramentoId()) || empty($vo->getId()) || empty($vo->getLaudo()))
         return 0;

      $vo->setDataEncerramento(Util::DataAtual());
      $vo->setHoraEncerramento(Util::HoraAtual());
      $vo->setFuncaoErro(FINALIZAR_CHAMADO);
      $vo->setCodLogado($vo->getTecnicoEncerramentoId());
      return $this->model->FinalizarChamadoModel($vo);
   }
}