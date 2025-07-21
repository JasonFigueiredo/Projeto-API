<?php

namespace Src\Model\SQL;


class SETOR_SQL
{

  // //COMANDO SQL PARA INSERIR SETOR
  // public static function INSERIR_SETOR(): string
  // {
  //   $sql = 'INSERT INTO tb_setor (nome_setor) VALUES (?)';
  //   return $sql;
  // }

  //COMANDO SQL PARA SELECIONAR SETOR
  public static function SELECIONAR_SETOR(): string
  {
    $sql = 'SELECT id, 
            nome_setor 
            FROM tb_setor 
            ORDER BY nome_setor';
    return $sql;
  }

//   //COMANDO SQL PARA ALTERAR SETOR POR ID
//   public static function ALTERAR_SETOR(): string
//   {
//     $sql = 'UPDATE tb_setor 
//             SET nome_setor = ? 
//             WHERE id = ?';
//     return $sql;
//   }

//   //COMANDO SQL PARA EXCLUIR SETOR POR ID
//   public static function EXCLUIR_SETOR(): string
//   {
//     $sql = 'DELETE FROM tb_setor 
//             WHERE id = ?';
//     return $sql;
//   }
  
}
