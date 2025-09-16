<?php

namespace Src\Model\SQL;

class USUARIO_SQL
{
  // ----- PASSO 1 "SQL 01" -----
  public static function VERIFICAR_EMAIL(): string
  {
    $sql = "SELECT COUNT(email_usuario) 
                     AS contar_email 
                   FROM tb_usuario 
                  WHERE email_usuario = ?";
    return $sql;
  }
  // ----- PASSO 1 "SQL 02" -----
  public static function CADASTRAR_ESTADO(): string
  {
    $sql = "INSERT INTO tb_estado (sigla_estado) 
            VALUES (?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 03" -----
  public static function CADASTRAR_CIDADE(): string
  {
    $sql = "INSERT INTO tb_cidade (nome_cidade, estado_id) 
            VALUES (?, ?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 04" -----
  public static function CADASTRAR_ENDERECO(): string
  {
    $sql = "INSERT INTO tb_endereco (rua, bairro, cep, usuario_id, cidade_id) 
            VALUES (?, ?, ?, ?, ?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 05" -----
  public static function VERIFICAR_CIDADE_CADASTRADA(): string
  {
    $sql = "SELECT ci.id AS id_cidade
              FROM tb_cidade  as ci
        inner join tb_estado as es
                on ci.estado_id = es.id
             WHERE ci.nome_cidade = ?
               AND es.sigla_estado = ?";
    return $sql;
  }
  // ----- PASSO 1 "SQL 06" -----
  public static function VERIFICAR_ESTADO_CADASTRADO(): string
  {
    $sql = "SELECT id
              FROM tb_estado
             WHERE sigla_estado = ?";
    return $sql;
  }
  // ----- PASSO 1 "SQL 07" -----
  public static function CADASTRAR_USUARIO(): string
  {
    $sql = "INSERT INTO tb_usuario
     (nome_usuario, tipo_usuario, cpf_usuario, status_usuario, tel_usuario, email_usuario, senha_usuario) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 08" -----
  public static function CADASTRAR_USUARIO_TECNICO(): string
  {
    $sql = "INSERT INTO tb_tecnico
     (usuario_id, nome_empresa) 
            VALUES (?, ?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 09" -----
  public static function CADASTRAR_USUARIO_FUNCIONARIO(): string
  {
    $sql = "INSERT INTO tb_funcionario
     (usuario_id, setor_id) 
            VALUES (?, ?)";
    return $sql;
  }
  // ----- PASSO 1 "SQL 10" -----
  public static function VERIFICAR_CPF(): string
  {
    $sql = "SELECT COUNT(cpf_usuario) 
                     AS contar_cpf 
                   FROM tb_usuario 
                  WHERE cpf_usuario = ?";
    return $sql;
  }

  public static function FILTRAR_USUARIO(): string
  {
    $sql = "SELECT id, nome_usuario, tipo_usuario, status_usuario
              FROM tb_usuario
             WHERE nome_usuario LIKE ?
               OR tipo_usuario LIKE ?
               OR status_usuario LIKE ?";
    return $sql;
  }
  // ----- PASSO 1 "SQL 11" -----
  public static function ALTERAR_STATUS(): string
  {
    $sql = "UPDATE tb_usuario 
              SET status_usuario = ?
            WHERE id = ?";
    return $sql;
  }

  public static function DETALHAR_USUARIO(): string
  {
    $sql = "SELECT usu.id,
                   usu.nome_usuario,
                   usu.cpf_usuario,
                   usu.email_usuario,
                   usu.tel_usuario,
                   usu.tipo_usuario,
                   en.rua,
                   en.bairro,
                   en.cep,
                   en.id as endereco_id,
                   en.cidade_id,
                   cid.nome_cidade,
                   est.sigla_estado,
                   tec.nome_empresa,
                   fun.setor_id
              FROM tb_usuario as usu
        INNER JOIN tb_endereco as en
                ON usu.id = en.usuario_id
        INNER JOIN tb_cidade as cid
                ON en.cidade_id = cid.id
        INNER JOIN tb_estado as est
                ON cid.estado_id = est.id
         LEFT JOIN tb_tecnico as tec
                ON usu.id = tec.usuario_id
         LEFT JOIN tb_funcionario as fun
                ON usu.id = fun.usuario_id
             WHERE usu.id = ?";
    return $sql;
  }

  public static function ALTERAR_USUARIO(): string
  {
    return "UPDATE tb_usuario 
            SET nome_usuario = ?, 
                email_usuario = ?, 
                cpf_usuario = ?, 
                tel_usuario = ? 
            WHERE id = ?";
  }

  public static function ALTERAR_ENDERECO(): string
  {
    return "UPDATE tb_endereco 
            SET cep = ?, 
                rua = ?, 
                bairro = ? 
            WHERE usuario_id = ?";
  }

  public static function ALTERAR_FUNCIONARIO(): string
  {
    return "UPDATE tb_funcionario 
            SET setor_id = ? 
            WHERE usuario_id = ?";
  }

  public static function ALTERAR_TECNICO(): string
  {
    return "UPDATE tb_tecnico 
            SET nome_empresa = ? 
            WHERE usuario_id = ?";
  }
}
