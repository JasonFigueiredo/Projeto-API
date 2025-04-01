<?php

namespace Src\Model;
use Exception;
use Src\Model\Conexao;
use Src\VO\TipoVO;
use Src\Model\SQL\TIPO_EQUIPAMENTO_SQL;

class TipoEquipamentoMODEL extends Conexao{

  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }
  
  public function CadastrarTipoEquipamentoMODEL(TipoVO $vo)
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::INSERIR_TIPO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getNome());

    try{
      $sql->execute();
      return 1;
    }
    catch (Exception $ex){
      return -1;
    }
  }

  public function ColsultarTipoEquipamentoModel()
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::SELECIONAR_TIPO_EQUIPAMENTO());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }
}
