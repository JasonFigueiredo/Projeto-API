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
}
