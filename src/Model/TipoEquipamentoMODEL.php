<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\TipoVO;
use Src\Model\SQL\TIPO_EQUIPAMENTO_SQL;
// Inserção de pagina desabilitado porque a procedure ja esta fazendo o CRUD no proprio DB

class TipoEquipamentoMODEL extends Conexao
{

  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }


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

  public function ConsultarTipoEquipamentoModel()
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::SELECIONAR_TIPO_EQUIPAMENTO());
    $sql->execute();
    return $sql->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function AlterarTipoEquipamentoMODEL(TipoVO $vo)
  {
    $sql = $this->conexao->prepare(TIPO_EQUIPAMENTO_SQL::ALTERAR_TIPO_EQUIPAMENTO());
    $i = 1;
    $sql->bindValue($i++, $vo->getNome());
    $sql->bindValue($i++, $vo->getId());

    try {
      $sql->execute();
      return 1;
    } catch (Exception $ex) {
      return -1;
    }
  }

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
