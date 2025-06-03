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

    public function FiltrarEquipamentoModel($tipo, $modelo)
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::FILTRAR_EQUIPAMENTO($tipo, $modelo));

        if ($tipo != "" && $modelo != "") {
            $sql->bindValue(1, $modelo);
            $sql->bindValue(2, $tipo);

        } elseif ($tipo == "" && $modelo != "") {
            $sql->bindValue(1, $modelo);
            
        } elseif ($tipo != "" && $modelo == "") {
            $sql->bindValue(1, $tipo);
        }

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

        public function DetalharEquipamentoModel($id): array | null
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::DETALHAR_EQUIPAMENTO());

        $sql->bindValue(1, $id);

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function ExcluirEquipamentoModel(EquipamentoVO $vo): int
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::EXCLUIR_EQUIPAMENTO());

        $sql->bindValue(1, $vo->getId());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }
}

