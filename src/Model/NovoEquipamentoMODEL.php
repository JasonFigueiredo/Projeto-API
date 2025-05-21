<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\EquipamentoVO;
use Src\Model\SQL\NOVO_EQUIPAMENTO_SQL;

class NovoEquipamentoMODEL extends Conexao
{

    private $conexao;

    public function __construct()
    {
        $this->conexao = parent::retornarConexao();
    }

    public function NovoEquipamentoModel(EquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::INSERIR_EQUIPAMENTO());
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
