<?php

namespace Src\Model\SQL;

class SETOR_SQL
{
  public static function INSERIR_SETOR(): string
  {
    $sql = 'INSERT INTO tb_setor (nome_setor) 
                 VALUES (?)';
                 return $sql;
  }
  
  public static function SELECIONAR_SETOR(): string
  {
    $sql = 'SELECT id, 
                   nome_setor 
              FROM tb_setor 
          ORDER BY nome_setor';
          return $sql;
  }

}
