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
  // -----PASSO 2 "MODEL 01" -----
  public function verificarEmailDuplicadoMODEL($email): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_EMAIL());
    $sql->bindValue(1, $email);
    $sql->execute();
    $resultado = $sql->fetch(\PDO::FETCH_ASSOC);
    return $resultado['contar_email'] > 0;
  }
  // -----PASSO 2 "MODEL 02" -----
  public function cadastrarEstadoMODEL($nomeEstado, $siglaEstado): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ESTADO());
    $sql->bindValue(1, $nomeEstado);
    $sql->bindValue(2, $siglaEstado);
    return $sql->execute();
  }
  // -----PASSO 2 "MODEL 03" -----
  public function cadastrarCidadeMODEL($nomeCidade, $idEstado): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_CIDADE());
    $sql->bindValue(1, $nomeCidade);
    $sql->bindValue(2, $idEstado);
    return $sql->execute();
  }
  // -----PASSO 2 "MODEL 04" -----
  public function cadastrarEnderecoMODEL($rua, $bairro, $cep, $usuarioId, $cidadeId): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ENDERECO());
    $sql->bindValue(1, $rua);
    $sql->bindValue(2, $bairro);
    $sql->bindValue(3, $cep);
    $sql->bindValue(4, $usuarioId);
    $sql->bindValue(5, $cidadeId);
    return $sql->execute();
  }
  // -----PASSO 2 "MODEL 05" -----
  public function verificarCidadeCadastradaMODEL($nomeCidade, $siglaEstado): ?int
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA());
    $sql->bindValue(1, $nomeCidade);
    $sql->bindValue(2, $siglaEstado);
    $sql->execute();
    $resultado = $sql->fetch(\PDO::FETCH_ASSOC);
    return $resultado['id_cidade'] ?? null;
  }
  // -----PASSO 2 "MODEL 06" -----
  public function verificarEstadoCadastradoMODEL($siglaEstado): ?int
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO());
    $sql->bindValue(1, $siglaEstado);
    $sql->execute();
    $resultado = $sql->fetch(\PDO::FETCH_ASSOC);
    return $resultado['id_estado'] ?? null;
  }
  // -----PASSO 2 "MODEL 07" -----
  public function cadastrarUsuarioMODEL($usuarioVO): int
  {

    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO());
    $i = 1;
    $sql->bindValue($i++, $usuarioVO->getNome());
    $sql->bindValue($i++, $usuarioVO->getTipo());
    $sql->bindValue($i++, $usuarioVO->getCpf());
    $sql->bindValue($i++, $usuarioVO->getStatus());
    $sql->bindValue($i++, $usuarioVO->getTel());
    $sql->bindValue($i++, $usuarioVO->getEmail());
    $sql->bindValue($i++, password_hash($usuarioVO->getSenha(), PASSWORD_DEFAULT));

    try {
      $this->conexao->beginTransaction();

      // cadastra na tb_usuario
      $sql->execute();

      // recupera o id do usuario cadastrado
      $id_user = $this->conexao->lastInsertId();
      switch ($usuarioVO->getTipo()) {
        // -----PASSO 2 "MODEL  08" -----
        case USUARIO_TECNICO:
          $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO_TECNICO());
          $i = 1;
          $sql->bindValue($i++, $id_user);
          $sql->bindValue($i++, $usuarioVO->getNomeEmpresa());
          // cadastra na tb_tecnico
          $sql->execute();
          break;
        case USUARIO_FUNCIONARIO:
          // -----PASSO 2 "MODEL 09" -----
          $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO_FUNCIONARIO());
          $i = 1;
          $sql->bindValue($i++, $id_user);
          $sql->bindValue($i++, $usuarioVO->getSetorId());
          // cadastra na tb_funcionario
          $sql->execute();
          break;
      }
      //Gravar endereço

      $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA());
      $i = 1;
      $sql->bindValue($i++, $id_user);
      $sql->bindValue($i++, $usuarioVO->getCidadeId());

      $sql->execute();

      return 1;
    } catch (Exception $ex) {
      echo $ex->getMessage();
      return -1;
    }
  }
}
