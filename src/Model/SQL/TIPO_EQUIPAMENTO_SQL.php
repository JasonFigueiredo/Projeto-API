<?php

namespace Src\Model\SQL;


class TIPO_EQUIPAMENTO_SQL
{
  public static function INSERIR_TIPO_EQUIPAMENTO(): string
  {
    $sql = "INSERT INTO tb_tipo (nome_tipo) VALUES (?)";
    return $sql; 
  }
}