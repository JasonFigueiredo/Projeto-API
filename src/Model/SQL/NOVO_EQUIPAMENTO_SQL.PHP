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

    public static function ALTERAR_EQUIPAMENTO()
    {
        $sql = "UPDATE tb_equipamento
                SET identificacao = ?,
                    descricao = ?,
                    tipo_id = ?,
                    modelo_id = ?
                WHERE id = ?";
        return $sql;
    }

    public static function DETALHAR_EQUIPAMENTO()
    {

        $sql = "SELECT id, 
                identificacao, 
                descricao, 
                situacao, 
                tipo_id, 
                modelo_id 
        FROM tb_equipamento 
        WHERE id = ?";

        return $sql;
    }

    public static function EXCLUIR_EQUIPAMENTO()
    {

        $sql = "DELETE FROM 
                tb_equipamento 
                WHERE id = ?";

        return $sql;
    }

    public static function FILTRAR_EQUIPAMENTO($idTipo, $idModelo)

    {
        $sql = 'SELECT eq.id as equipamento_id,
                       identificacao,
                       descricao,
                       situacao,
                       data_descarte,
                       motivo_descarte,
                       nome_modelo,
                       nome_tipo,
                       (select count(*)
                          from tb_alocar as al
                         where al.equipamento_id = equipamento_id
                           and al.situacao != ?) as esta_alocado
                FROM tb_equipamento as eq
                INNER JOIN tb_modelo as mo
                ON eq.modelo_id = mo.id
                INNER JOIN tb_tipo as ti
                ON eq.tipo_id = ti.id';

        if ($idTipo != "" && $idModelo != "") {
            $sql .= ' WHERE eq.modelo_id = ? AND eq.tipo_id = ?';
        } elseif ($idTipo == "" && $idModelo != "") {
            $sql .= ' WHERE eq.modelo_id = ?';
        } elseif ($idTipo != "" && $idModelo == "") {
            $sql .= ' WHERE eq.tipo_id = ?';
        }

        return $sql;
    }

    public static function DESCARTE_EQUIPAMENTO()
    {
        $sql = "UPDATE tb_equipamento
                SET data_descarte = ?,
                    motivo_descarte = ?,
                    situacao = ?
                WHERE id = ?";
        return $sql;
    }
    public static function SELECIONAR_EQUIPAMENTO_NAO_ALOCADOS()
    {
        $sql = "SELECT eq.id as equipamento_id,
				eq.identificacao,
				ti.nome_tipo,
				mo.nome_modelo
		        from tb_equipamento as eq
                inner join tb_tipo as ti
		        on eq.tipo_id = ti.id
                inner join tb_modelo as mo
		        on eq.modelo_id = mo.id
		        where eq.situacao = ?
		        and eq.id   
                not in (select eq.id
				from tb_alocar
				where situacao != ?);";
        return $sql;
    }
}
