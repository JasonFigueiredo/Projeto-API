<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\SetorVO;
use Src\Model\SQL\SETOR_SQL;

class SetorMODEL extends Conexao
{

  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }


  /// Método para cadastrar um tipo de equipamento
  /// Retorna 1 se o cadastro foi realizado com sucesso, -1 caso contrário
  // public function CadastrarSetorMODEL(SetorVO $vo): int
  // {
  //   $sql = $this->conexao->prepare(SETOR_SQL::INSERIR_SETOR());
  //   $sql->bindValue(1, $vo->getNome());

  //   try {
  //     $sql->execute();
  //     return 1;
  //   } catch (Exception $ex) {
  //     $vo->setErroTecnico($ex->getMessage());
  //     parent::GravarErroLog($vo);
  //     return -1;
  //   }
  // }

  /// Método para consultar todos os tipos de equipamentos
  /// Retorna um array com os tipos de equipamentos cadastrados
  public function ConsultarSetorModel()
  {
    $sql = $this->conexao->prepare(SETOR_SQL::SELECIONAR_SETOR());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }


  // /// Método para alterar um tipo de equipamento
  // /// Retorna 1 se a alteração foi realizada com sucesso, -1 caso contrário
  // public function AlterarSetorMODEL(SetorVO $vo)
  // {
  //   $sql = $this->conexao->prepare(SETOR_SQL::ALTERAR_SETOR());
  //   $sql->bindValue(1, $vo->getNome());
  //   $sql->bindValue(2, $vo->getId());

  //   try {
  //     $sql->execute();
  //     return 1;
  //   } catch (Exception $ex) {
  //     return -1;
  //   }
  // }

  /// Método para excluir um tipo de equipamento
  // /// Retorna 1 se a exclusão foi realizada com sucesso, -1 caso contrário
  // public function ExcluirSetorMODEL(SetorVO $vo)
  // {
  //   $sql = $this->conexao->prepare(SETOR_SQL::EXCLUIR_SETOR());
  //   $sql->bindValue(1, $vo->getId());

  //   try {
  //     $sql->execute();
  //     return 1;
  //   } catch (Exception $ex) {
  //     return -1;
  //   }
  // }
}
