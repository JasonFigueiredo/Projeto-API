<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\ModeloVO;
use Src\Model\SQL\MODELO_EQUIPAMENTO_SQL;

class ModeloEquipamentoMODEL extends Conexao
{

  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }

  public function CadastrarModeloEquipamentoMODEL(ModeloVO $vo): int
  {
    $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::INSERIR_MODELO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getNome());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      $vo->setErroTecnico($ex->getMessage());
      parent::GravarErroLog($vo);
      return -1;
    }
  }

  public function ConsultarModeloEquipamentoModel()
  {
    $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::SELECIONAR_MODELO_EQUIPAMENTO());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function AlterarModeloEquipamentoMODEL(ModeloVO $vo)
  {
    $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::ALTERAR_MODELO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getNome());
    $sql->bindValue(2, $vo->getId());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      $vo->setErroTecnico($ex->getMessage());
      parent::GravarErroLog($vo);
      return -1;
    }
  }

  public function ExcluirModeloEquipamentoMODEL(ModeloVO $vo)
  {
    $sql = $this->conexao->prepare(MODELO_EQUIPAMENTO_SQL::EXCLUIR_MODELO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getId());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      $vo->setErroTecnico($ex->getMessage());
      parent::GravarErroLog($vo);
      return -1;
    }
  }
}
