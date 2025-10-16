<?php

namespace Src\Model\SQL;

class SETOR_SQL
{
  public static function INSERIR_SETOR(): string //procedure finalizada
  {
    $sql = 'INSERT INTO tb_setor (nome_setor) 
                 VALUES (?)';
                 return $sql;
  }
  
  public static function SELECIONAR_SETOR(): string //procedure finalizada
  {
    $sql = 'SELECT id, 
                   nome_setor 
              FROM tb_setor 
          ORDER BY nome_setor';
          return $sql;
  }

  public static function EXCLUIR_SETOR(): string //procedure finalizada
  {
    $sql = 'DELETE FROM tb_setor 
            WHERE id = ?';
    return $sql;
  }

  public static function BUSCAR_SETOR_POR_ID(): string //procedure finalizada
  {
    $sql = 'SELECT id, nome_setor 
            FROM tb_setor 
            WHERE id = ?';
    return $sql;
  }

  public static function ALTERAR_SETOR(): string //procedure finalizada
  {
    $sql = 'UPDATE tb_setor 
               SET nome_setor = ? 
             WHERE id = ?';
    return $sql;
  }
}
