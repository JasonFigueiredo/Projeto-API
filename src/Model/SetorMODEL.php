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
}