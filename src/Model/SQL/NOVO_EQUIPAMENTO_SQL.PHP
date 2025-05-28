<?php

namespace Src\Model\SQL;

class NOVO_EQUIPAMENTO_SQL
{

    public static function INSERIR_EQUIPAMENTO()
    {

        $sql = "INSERT INTO 
        tb_equipamento (identificacao, descricao, situacao, tipo_id, modelo_id)
        values (?,?,?,?,?)";

        return $sql;
    }

    public static function FILTRAR_EQUIPAMENTO($idTipo, $idModelo)

    {
        $sql = "SELECT eq.id as equipamento_id,
                       identificacao,
                       descricao,
                       situacao,
                       data_descarte,
                       motivo_descarte,
                       nome_modelo,
                       nome_tipo
                FROM tb_equipamento as eq
                INNER JOIN tb_modelo as mo
                    ON eq.modelo_id = mo.id
                INNER JOIN tb_tipo as ti
                    ON eq.tipo_id = ti.id";
        if ($idTipo != "" && $idModelo != "") {
            $sql .= ' WHERE eq.modelo_id = ? AND eq.tipo_id = ?';
        } elseif ($idTipo == "" && $idModelo != "") {
            $sql .= ' WHERE eq.modelo_id = ?';
        } elseif ($idTipo != "" && $idModelo == "") {
            $sql .= ' WHERE eq.tipo_id = ?';
        }

        return $sql;
    }
}
