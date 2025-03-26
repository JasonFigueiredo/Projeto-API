<?php

namespace Src\Model\SQL;


class TIPO_EQUIPAMENTO_SQL
{
  public static function INSERIR_TIPO_EQUIPAMENTO()
  {
    $sql = "INSERT INTO tb_tipo 
                    FROM nome_tipo
                    VALUES (?)";
    return $sql; 
  }
}