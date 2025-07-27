<?php

namespace Src\Model;

use Exception;
use Src\Model\Conexao;
use Src\VO\AlocarVO;
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

    public function AlocarEquipamentoMODEL(AlocarVO $vo): int
    {

        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::ALOCAR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataAlocar());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getSetorId());
        $sql->bindValue($i++, $vo->getEquipamentoId());
        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function FiltrarEquipamentoModel($tipo, $modelo, $situacao): array
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::FILTRAR_EQUIPAMENTO($tipo, $modelo));
        $i = 1;
        $sql->bindValue($i++, $situacao);
        if ($tipo != "" && $modelo != "") {
            $sql->bindValue($i++, $modelo);
            $sql->bindValue($i++, $tipo);
        } elseif ($tipo == "" && $modelo != "") {
            $sql->bindValue($i++, $modelo);
        } elseif ($tipo != "" && $modelo == "") {
            $sql->bindValue($i++, $tipo);
        }

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function DetalharEquipamentoModel($id): array | String
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::DETALHAR_EQUIPAMENTO());

        $sql->bindValue(1, $id);

        $sql->execute();
        return $sql->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function ListarEquipamentosAlocadosSetorMODEL(int $idSetor, int $situacaoAlocado): array | null
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::EQUIPAMENTOS_ALOCADOS_SETOR());

        $sql->bindValue(1, $idSetor);
        $sql->bindValue(2, $situacaoAlocado);

        $sql->execute();
        return $sql->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function SelecionarEquipamentoNaoAlocadosMODEL(int $situacao_equipamento, int $situacao_alocar): array | null
    {
        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::SELECIONAR_EQUIPAMENTO_NAO_ALOCADOS());
        $i = 1;
        $sql->bindValue($i++, $situacao_equipamento);
        $sql->bindValue($i++, $situacao_alocar);

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
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function AlterarEquipamentoModel(EquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::ALTERAR_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getIdentificacao());
        $sql->bindValue($i++, $vo->getDescricao());
        $sql->bindValue($i++, $vo->getTipo());
        $sql->bindValue($i++, $vo->getModelo());
        $sql->bindValue($i++, $vo->getId());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            $vo->setErroTecnico($ex->getMessage());
            parent::GravarErroLog($vo);
            return -1;
        }
    }

    public function DescartarEquipamentoModel(EquipamentoVO $vo): int
    {

        $sql = $this->conexao->prepare(NOVO_EQUIPAMENTO_SQL::DESCARTE_EQUIPAMENTO());
        $i = 1;
        $sql->bindValue($i++, $vo->getDataDescarte());
        $sql->bindValue($i++, $vo->getMotivoDescarte());
        $sql->bindValue($i++, $vo->getSituacao());
        $sql->bindValue($i++, $vo->getId());

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
