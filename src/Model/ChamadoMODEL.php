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
}