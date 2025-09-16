<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\UsuarioVO;
use Src\VO\TecnicoVO;
use Src\VO\FuncionarioVO;
use Src\Model\SQL\USUARIO_SQL;

// Importar as constantes
require_once __DIR__ . '/../Config/fixos.php';

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
    $sql->bindValue(1, $siglaEstado);
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
  public function cadastrarUsuarioMODEL(UsuarioVO $usuarioVO): int
  {

    $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO());
    $i = 1;
    $sql->bindValue($i++, $usuarioVO->getNome());
    $sql->bindValue($i++, $usuarioVO->getTipo());
    $sql->bindValue($i++, $usuarioVO->getCPF());
    $sql->bindValue($i++, $usuarioVO->getStatus());
    $sql->bindValue($i++, $usuarioVO->getTel());
    $sql->bindValue($i++, $usuarioVO->getEmail());
    $sql->bindValue($i++, $usuarioVO->getSenha());

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
          $sql->bindValue($i++, $usuarioVO instanceof TecnicoVO ? $usuarioVO->getNomeEmpresa() : '');
          // cadastra na tb_tecnico
          $sql->execute();
          break;
        case USUARIO_FUNCIONARIO:
          // -----PASSO 2 "MODEL 09" -----
          $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_USUARIO_FUNCIONARIO());
          $i = 1;
          $sql->bindValue($i++, $id_user);
          $sql->bindValue($i++, $usuarioVO instanceof FuncionarioVO ? $usuarioVO->getIdSetor() : 0);
          // cadastra na tb_funcionario
          $sql->execute();
          break;
      }

      $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CIDADE_CADASTRADA());

      $sql->bindValue(1, $usuarioVO->getCidade());
      $sql->bindValue(2, $usuarioVO->getEstado());
      // cadastra na tb_endereco
      $sql->execute();
      $tem_cidade = $sql->fetchAll(\PDO::FETCH_ASSOC);

      $id_cidade = 0;
      $id_estado = 0;
      $tem_estado = [];

      if (count($tem_cidade) > 0) {
        $id_cidade = $tem_cidade[0]['id_cidade'];
      } else {

        $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_ESTADO_CADASTRADO());

        $sql->bindValue(1, $usuarioVO->getEstado());
        // cadastra na tb_estado
        $sql->execute();
        $tem_estado = $sql->fetchAll(\PDO::FETCH_ASSOC);
      }

      if (count($tem_estado) > 0) {
        $id_estado = $tem_estado[0]['id'];
      } else {
        // cadastra na tb_estado
        $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ESTADO());
        $sql->bindValue(1, $usuarioVO->getEstado());
        $sql->execute();
        $id_estado = $this->conexao->lastInsertId();
      }

      $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_CIDADE());
      $sql->bindValue(1, $usuarioVO->getCidade());
      $sql->bindValue(2, $id_estado);
      
      $sql->execute();
      $id_cidade = $this->conexao->lastInsertId();

      $sql = $this->conexao->prepare(USUARIO_SQL::CADASTRAR_ENDERECO());
      $i = 1;
      $sql->bindValue($i++, $usuarioVO->getRua());
      $sql->bindValue($i++, $usuarioVO->getBairro());
      $sql->bindValue($i++, $usuarioVO->getCep());
      $sql->bindValue($i++, $id_user);
      $sql->bindValue($i++, $id_cidade);

      $sql->execute();

      $this->conexao->commit();
      return 1;
    } catch (Exception $ex) {
      $this->conexao->rollBack();
      $usuarioVO->setErroTecnico($ex->getMessage());
      parent::GravarErroLog($usuarioVO);
      return -1;
    }
  }
  // -----PASSO 2 "MODEL 10" -----
  public function verificarCpfDuplicadoMODEL($cpf): bool
  {
    $sql = $this->conexao->prepare(USUARIO_SQL::VERIFICAR_CPF());
    $sql->bindValue(1, $cpf);
    $sql->execute();
    $resultado = $sql->fetch(\PDO::FETCH_ASSOC);
    return $resultado['contar_cpf'] > 0;
  }
}
