<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\TipoVO;
use Src\Model\SQL\TIPO_EQUIPAMENTO_SQL;

class TipoEquipamentoMODEL extends Conexao
{

  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }


  /// Método para cadastrar um tipo de equipamento
  /// Retorna 1 se o cadastro foi realizado com sucesso, -1 caso contrário
  public function CadastrarTipoEquipamentoMODEL(TipoVO $vo): int
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::INSERIR_TIPO_EQUIPAMENTO());
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

  /// Método para consultar todos os tipos de equipamentos
  /// Retorna um array com os tipos de equipamentos cadastrados
  public function ColsultarTipoEquipamentoModel()
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::SELECIONAR_TIPO_EQUIPAMENTO());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }


  /// Método para alterar um tipo de equipamento
  /// Retorna 1 se a alteração foi realizada com sucesso, -1 caso contrário
  public function AlterarTipoEquipamentoMODEL(TipoVO $vo)
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::ALTERAR_TIPO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getNome());
    $sql->bindValue(2, $vo->getId());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      return -1;
    }
  }

  /// Método para excluir um tipo de equipamento
  /// Retorna 1 se a exclusão foi realizada com sucesso, -1 caso contrário
  public function ExcluirTipoEquipamentoMODEL(TipoVO $vo)
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::EXCLUIR_TIPO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getId());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      return -1;
    }
  }
}
