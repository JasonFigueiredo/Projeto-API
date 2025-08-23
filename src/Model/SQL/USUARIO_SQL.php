<?php

namespace Src\Model\SQL;

class USUARIO_SQL
{
  public static function VERIFICAR_EMAIL()
  {
    $sql = "SELECT COUNT(email_usuario) 
                     AS contar_email 
                   FROM tb_usuario 
                  WHERE email_usuario = ?";
    return $sql;  
  }
}