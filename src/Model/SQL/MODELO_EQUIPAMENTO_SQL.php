<?php

namespace Src\Model\SQL;

use Exception;
use Src\Model\Conexao;
use Src\VO\TipoVO;
// Removed redundant import to avoid duplicate declaration error

class MODELO_EQUIPAMENTO_SQL
{

  //COMANDO SQL PARA INSERIR TIPO DE EQUIPAMENTO
  public static function INSERIR_MODELO_EQUIPAMENTO(): string
  {
    $sql = 'INSERT INTO tb_modelo (nome_modelo) VALUES (?)';
    return $sql;
  }

  //COMANDO SQL PARA SELECIONAR MODELO DE EQUIPAMENTO  
  public static function SELECIONAR_MODELO_EQUIPAMENTO(): string
  {
    $sql = 'SELECT id, 
            nome_modelo 
            FROM tb_modelo 
            ORDER BY nome_modelo';
    return $sql;
  }

  //COMANDO SQL PARA ALTERAR MODELO DE EQUIPAMENTO POR ID
  public static function ALTERAR_MODELO_EQUIPAMENTO(): string
  {
    $sql = 'UPDATE tb_modelo 
            SET nome_modelo = ? 
            WHERE id = ?';
    return $sql;
  }

  //COMANDO SQL PARA EXCLUIR MODELO DE EQUIPAMENTO POR ID
  public static function EXCLUIR_MODELO_EQUIPAMENTO(): string
  {
    $sql = 'DELETE FROM tb_modelo 
            WHERE id = ?';
    return $sql;
  }
}
