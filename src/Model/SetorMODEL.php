<?php

namespace Src\Model;

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

  public function ConsultarSetorModel()
  {
    $sql = $this->conexao->prepare(SETOR_SQL::SELECIONAR_SETOR());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }
}
