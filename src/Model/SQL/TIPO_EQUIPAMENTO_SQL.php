<?php

namespace Src\Model\SQL;


class TIPO_EQUIPAMENTO_SQL
{
  public static function INSERIR_TIPO_EQUIPAMENTO()
  {
    $sql = "INSERT INTO tb_tipo (nome_tipo) VALUES (?)";
    return $sql;
  }

  public static function SELECIONAR_TIPO_EQUIPAMENTO()
  {
    $sql = 'SELECT id, 
            nome_tipo 
            FROM tb_tipo 
            ORDER BY nome_tipo';
    return $sql;
  }
}
