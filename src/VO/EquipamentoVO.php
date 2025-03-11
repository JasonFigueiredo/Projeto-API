<?php

namespace Src\VO;

class EquipamentoVO
{
    private $id;
    private $identificacao;
    private $descricao;
    private $situacao;
    private $data_descarte;
    private $motivo_descarte;
    private $modelo_id;
    private $alocar_id;
    private $alocar_setor_id;
    private $tipo_id;

    // get set de ID
    public function setId(int $p_id): void
    {
        $this->id = $p_id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // get set de IDENTIFICACAO
    public function setIdentificacao(string $identificacao): void
    {
        $this->identificacao = $identificacao;
    }
    public function getIdentificacao(): string
    {
        return $this->identificacao;
    }

    // get set de DESCRICAO
    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    // get set de SITUACAO
    public function setSituacao(string $situacao): void
    {
        $this->situacao = $situacao;
    }
    public function getSituacao(): string
    {
        return $this->situacao;
    }

    // get set de DATA_DESCARTE
    public function setDataDescarte(int $data_descarte): void
    {
        $this->data_descarte = $data_descarte;
    }
    public function getDataDescarte(): int
    {
        return $this->data_descarte;
    }

    // get set de MOTIVO_DESCARTE
    public function setMotivoDescarte(string $motivo_descarte): void
    {
        $this->motivo_descarte = $motivo_descarte;
    }
    public function getMotivoDescarte(): string
    {
        return $this->motivo_descarte;
    }

    // get set de MODELO_ID
    public function setModeloId(int $modelo_id): void
    {
        $this->modelo_id = $modelo_id;
    }
    public function getModeloId(): int
    {
        return $this->modelo_id;
    }

    // get set de ALOCAR_ID
    public function setAlocarId(int $alocar_id): void
    {
        $this->alocar_id = $alocar_id;
    }
    public function getAlocarId(): int
    {
        return $this->alocar_id;
    }

    // get set de ALOCAR_SETOR_ID
    public function setAlocarSetorId(int $alocar_setor_id): void
    {
        $this->alocar_setor_id = $alocar_setor_id;
    }
    public function getAlocarSetorId(): int
    {
        return $this->alocar_setor_id;
    }

    // get set de TIPO_ID
    public function setTipoId(int $tipo_id): void
    {
        $this->tipo_id = $tipo_id;
    }
    public function getTipoId(): int
    {
        return $this->tipo_id;
    }
}
