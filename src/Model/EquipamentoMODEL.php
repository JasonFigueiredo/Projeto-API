<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\EquipamentoVO;
use Src\Model\SQL\EQUIPAMENTO_SQL;

class EquipamentoMODEL extends Conexao
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    public function CadastrarEquipamento(EquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(EQUIPAMENTO_SQL::INSERIR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getIdentificacao());
        $sql->bindValue($i++, $vo->getDescricao());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getModelo());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }
}
