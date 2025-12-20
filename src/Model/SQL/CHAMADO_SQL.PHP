<?php

namespace Src\Model\SQL;

class CHAMADO_SQL
{
   public static function ABRIR_CHAMADO(): string
   {
      $sql = 'INSERT INTO tb_chamado
               (data_abertura , hora_abertura, problema, funcionario_usuario_id, alocar_id)
               Values
               (?,?,?,?,?)';

      return $sql;
   }

   public static function ATUALIZAR_ALOCAMENTO(){
      $sql = 'UPDATE tb_alocar
               SET situacao = ?
               WHERE id = ?';

      return $sql;
   
   }
}
