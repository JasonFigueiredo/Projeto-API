<?php

namespace Src\Model;

use Src\Model\Conexao;
use Src\VO\SetorVO;
use Src\Model\SQL\SETOR_SQL;
use \Exception;

class SetorMODEL extends Conexao
{
  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }

  public function CadastrarSetorMODEL(SetorVO $vo)
  {
    $sql = $this->conexao->prepare(SETOR_SQL::INSERIR_SETOR());
    $sql->bindValue(1, $vo->getNome());
    
    try {
        $sql->execute();
        return 1;

    } catch (Exception $ex) {
        echo $ex->getMessage();
        return -1;
    }
  }

  public function ConsultarSetorMODEL()
  {
    $sql = $this->conexao->prepare(SETOR_SQL::SELECIONAR_SETOR());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function ExcluirSetorMODEL(SetorVO $vo)
  {
    $sql = $this->conexao->prepare(SETOR_SQL::EXCLUIR_SETOR());
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

  public function AlterarSetorMODEL(SetorVO $vo)
  {
    $sql = $this->conexao->prepare(SETOR_SQL::ALTERAR_SETOR());
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
}