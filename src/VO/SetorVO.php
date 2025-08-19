<?php
namespace Src\VO;

use Src\_Public\Util;

class SetorVO extends LogErroVO
{

  private $id;
  private $nome;

  public function setId(int $id): void
  {
    $this->id = $id;
  }

  public function getId(): int
  {
    return $this->id ?? 0;
  }

    public function setNome(?string $nome)
  {
    $this->nome = $nome ? Util::RemoverTags($nome) : '';
  }
  
  public function getNome(): string
  {
    return $this->nome;
  }
}
