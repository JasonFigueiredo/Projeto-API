<?php

namespace Src\Model\SQL;

class CHAMADO_SQL
{
   public static function ABRIR_CHAMADO(): string
   {
      $sql = 'INSERT INTO tb_chamado
               (data_abertura , hora_abertura, problema, funcionario_id, alocar_id)
               Values
               (?,?,?,?,?)';

      return $sql;
   }

   public static function ATUALIZAR_ALOCAMENTO()
   {
      $sql = 'UPDATE tb_alocar
               SET situacao = ?
               WHERE id = ?';

      return $sql;

   }

   public static function FILTRAR_CHAMADO($situacao, $setor)
   {
      $sql = 'SELECT chamado.id as chamado_id,
                  tipo.nome_tipo,
                  modelo.nome_modelo,
                  equip.identificacao,
                  chamado.data_abertura,
                  chamado.hora_abertura,
                  chamado.problema as problema_descricao,
                  chamado.data_atendimento,
                  chamado.hora_atendimento,
                  chamado.data_encerramento,
                  chamado.hora_encerramento,
                  chamado.laudo,
                  chamado.alocar_id,
                  usuario_tec_atend.nome_usuario as tecnico_atendimento,
                  usuario_tec_final.nome_usuario as tecnico_finalizado,
                  usuario_func.nome_usuario as usuario_nome,
                  CONCAT(tipo.nome_tipo, " - ", modelo.nome_modelo, " / ID: ", equip.identificacao) as equipamento_nome

             from tb_chamado as chamado
       inner join tb_funcionario as func
               on chamado.funcionario_id = func.usuario_id
       inner join tb_usuario as usuario_func
               on func.usuario_id = usuario_func.id
       inner join tb_alocar as alo
               on chamado.alocar_id = alo.id
       inner join tb_equipamento as equip
               on alo.equipamento_id = equip.id 
       inner join tb_tipo as tipo
               on equip.tipo_id = tipo.id
       inner join tb_modelo as modelo
               on equip.modelo_id = modelo.id
        left join tb_tecnico as tec_atend
               on chamado.tecnico_atendimento_id = tec_atend.usuario_id
        left join tb_usuario as usuario_tec_atend
               on tec_atend.usuario_id = usuario_tec_atend.id
        left join tb_tecnico as tec_finaliza
               on chamado.tecnico_finalizar_id = tec_finaliza.usuario_id
        left join tb_usuario as usuario_tec_final
               on tec_finaliza.usuario_id = usuario_tec_final.id';

      switch ($situacao) {
         case SIT_CHAMADO_AGUARDANDO:
            $sql .= " WHERE chamado.tecnico_atendimento_id IS NULL " . ($setor ? " AND alo.setor_id = ?" : "");
            break;

         case SIT_CHAMADO_ANDAMENTO:
            $sql .= " WHERE chamado.tecnico_atendimento_id IS NOT NULL  and chamado.tecnico_finalizar_id IS NULL " . ($setor ? " AND alo.setor_id = ?" : "");
            break;

         case SIT_CHAMADO_ENCERRADO:
            $sql .= " WHERE chamado.tecnico_finalizar_id IS NOT NULL " . ($setor ? " AND alo.setor_id = ?" : "");
            break;

         default:
            $sql .= ($setor ? ' WHERE alo.setor_id = ?' : '');
            break;
      }
      return $sql;
   }

   public static function ATENDER_CHAMADO(): string
   {
      $sql = 'UPDATE tb_chamado
               SET data_atendimento = ?,
                   hora_atendimento = ?,
                   tecnico_atendimento_id = ?
             WHERE id = ?';

      return $sql;
   }

   public static function FINALIZAR_CHAMADO(): string
   {
      $sql = 'UPDATE tb_chamado
               SET data_encerramento = ?,
                   hora_encerramento = ?,
                   tecnico_finalizar_id = ?,
                   laudo = ?
             WHERE id = ?';

      return $sql;
   }
}