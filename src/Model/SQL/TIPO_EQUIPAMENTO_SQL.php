<?php
// apos a criação da PROCEDURE não é mais necessario esse arquivo de SQL, pois o CRUD ja esta no proprio DB
// atravez da PROCEDURE, onde ela ja faz todo esse trabalho.
namespace Src\Model\SQL;


class TIPO_EQUIPAMENTO_SQL
{

  //COMANDO SQL PARA INSERIR TIPO DE EQUIPAMENTO
  public static function INSERIR_TIPO_EQUIPAMENTO(): string
  {
    $sql = 'INSERT INTO tb_tipo (nome_tipo) VALUES (?)';
    return $sql;
  }

  //COMANDO SQL PARA SELECIONAR TIPO DE EQUIPAMENTO  
  public static function SELECIONAR_TIPO_EQUIPAMENTO(): string
  {
    $sql = 'SELECT id, 
            nome_tipo 
            FROM tb_tipo 
            ORDER BY nome_tipo';
    return $sql;
  }

  //COMANDO SQL PARA ALTERAR TIPO DE EQUIPAMENTO POR ID
  public static function ALTERAR_TIPO_EQUIPAMENTO(): string
  {
    $sql = 'UPDATE tb_tipo 
            SET nome_tipo = ? 
            WHERE id = ?';
    return $sql;
  }

  //COMANDO SQL PARA EXCLUIR TIPO DE EQUIPAMENTO POR ID
  public static function EXCLUIR_TIPO_EQUIPAMENTO(): string
  {
    $sql = 'DELETE FROM tb_tipo 
            WHERE id = ?';
    return $sql;
  }
  
}
