<?php

namespace Src\Model;
use Exception;
use Src\Model\Conexao;
use Src\VO\TipoVO;
use Src\Model\SQL\TIPO_EQUIPAMENTO_SQL;

class TipoEquipamentoMODEL extends Conexao{
  
  public function CadastrarTipoEquipamento(TipoVO $vo)
  {
    $conexao = parent::retornarConexao();
    $sql = $conexao->prepare(TIPO_EQUIPAMENTO_SQL::INSERIR_TIPO_EQUIPAMENTO());
    $sql->bindValue(1, $vo->getNome());

    try{
      $sql->execute();
      return 1;
    }
    catch (Exception $ex){
      return -1;
    }
  }
}