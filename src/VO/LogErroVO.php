<?php

namespace Src\VO;

use Src\_Public\Util;

class LogErroVO{

  private $erro_tecnico;
  private $cod_logado;
  private $funcao_erro;

  public function getErroTecnico(): string
  {
      return $this->erro_tecnico;
  }

  public function setErroTecnico(string $p): void
  {
      $this->erro_tecnico = $p;
  }

  public function getCodLogado(): int
  {
      return $this->cod_logado;
  }

  public function setCodLogado(int $p): void
  {
      $this->cod_logado = $p;
  }

  public function getFuncaoErro(): string
  {
      return $this->funcao_erro;
  }

  public function setFuncaoErro(string $p): void
  {
      $this->funcao_erro = $p;
  }

  public function getHoraErro(): string
  {
      return Util::HoraAtual();
  }
  public function getDataErro(): string
  {
      return Util::DataAtual();
  }

  
}