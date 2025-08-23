<?php
namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\UsuarioVO;
use Src\Model\SQL\USUARIO_SQL;

class UsuarioMODEL extends Conexao
{
  private $conexao;

  public function __construct()
  {
    $this->conexao = parent::retornarConexao();
  }

  public function verificarEmailDuplicadoMODEL($email): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_EMAIL());
    $sql->bindValue(1, $email);
    $sql->execute();
    $ver_email = $sql->fetchAll(\PDO::FETCH_ASSOC);
    return $ver_email[0]['contar_email'] == 0 ? false : true;
  }
}