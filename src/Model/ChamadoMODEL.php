<?php

namespace Src\Model;

use Exception;
use Src\VO\ChamadoVO;
use Src\Model\SQL\CHAMADO_SQL;
use Src\Model\Conexao;

class ChamadoMODEL extends Conexao
{
   private $conexao;

   public function __construct()
   {
      $this->conexao = parent::retornarConexao();
   }

   public function FiltrarChamadoModel(int $situacao, int $setor_id ): array | null
   {
      $tem_setor = $setor_id == -1 ? false : true;
      $sql = $this->conexao->prepare(CHAMADO_SQL::FILTRAR_CHAMADO($situacao, $tem_setor ? $setor_id : null));
      if ($tem_setor) {
         $sql->bindValue(1, $setor_id);
      }
      $sql->execute();
      return $sql->fetchAll(\PDO::FETCH_ASSOC);
   }

   public function AbrirChamadoModel(ChamadoVO $vo): int
   {

      $sql = $this->conexao->prepare(CHAMADO_SQL::ABRIR_CHAMADO());
      $i = 1;
      $sql->bindValue($i++, $vo->getDataAbertura());
      $sql->bindValue($i++, $vo->getHoraAbertura());
      $sql->bindValue($i++, $vo->getProblema());
      $sql->bindValue($i++, $vo->getIdFuncionario());
      $sql->bindValue($i++, $vo->getIdAlocar());
      $this->conexao->beginTransaction();
      try {
         $sql->execute();

         $sql = $this->conexao->prepare(CHAMADO_SQL::ATUALIZAR_ALOCAMENTO());
         $i = 1;
         $sql->bindValue($i++, $vo->getSituacao());
         $sql->bindValue($i++, $vo->getIdAlocar());

         $sql->execute();
         $this->conexao->commit();
         return 1;
      } catch (Exception $ex) {
         $vo->setErroTecnico($ex->getMessage());
         parent::GravarErroLog($vo);
         $this->conexao->rollBack();
         return -1;
      }
   }

   public function AtenderChamadoModel(ChamadoVO $vo): int
   {
      $sql = $this->conexao->prepare(CHAMADO_SQL::ATENDER_CHAMADO());
      $i = 1;
      $sql->bindValue($i++, $vo->getDataAtendimento());
      $sql->bindValue($i++, $vo->getHoraAtendimento());
      $sql->bindValue($i++, $vo->getIdTecnicoAtendimento());
      $sql->bindValue($i++, $vo->getId());
      try {
         $sql->execute();
         return 1;
      } catch (Exception $ex) {
         $vo->setErroTecnico($ex->getMessage());
         parent::GravarErroLog($vo);
         $this->conexao->rollBack();
         return -1;
      }
   }

   public function FinalizarChamadoModel(ChamadoVO $vo): int
   {
      $this->conexao->beginTransaction();

      try {
         $sql = $this->conexao->prepare(CHAMADO_SQL::FINALIZAR_CHAMADO());
         $i = 1;
         $sql->bindValue($i++, $vo->getDataEncerramento());
         $sql->bindValue($i++, $vo->getHoraEncerramento());
         $sql->bindValue($i++, $vo->getTecnicoEncerramentoId());
         $sql->bindValue($i++, $vo->getLaudo());
         $sql->bindValue($i++, $vo->getId());
         $sql->execute();

         $sql = $this->conexao->prepare(CHAMADO_SQL::ATUALIZAR_ALOCAMENTO());
         $i = 1;
         $sql->bindValue($i++, SITUACAO_EQUIPAMENTO_ALOCADO);
         $sql->bindValue($i++, $vo->getIdAlocar());
         $sql->execute();

         $this->conexao->commit();
         return 1;
      } catch (Exception $ex) {
         $vo->setErroTecnico($ex->getMessage());
         parent::GravarErroLog($vo);
         $this->conexao->rollBack();
         return -1;
      }
   }
}