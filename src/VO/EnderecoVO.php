<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\LogErroVO;

class EnderecoVO extends LogErroVO
{
 private $id;
 private $rua;
 private $bairro;
 private $cep;
 private $usuario_id;
 private $cidade;
 private $estado;

 // ----ID---
 public function getId(): int
 {
  return $this->id;
 }
 public function setId(int $id): void
 {
  $this->id = $id;
 }

 // ----RUA---
 public function getRua(): string
 {
  return $this->rua;
 }
 public function setRua(string $rua): void
 {
  $this->rua = $rua;
 }

 // ----BAIRRO---
 public function getBairro(): string
 {
  return $this->bairro;
 }
 public function setBairro(string $bairro): void
 {
  $this->bairro = $bairro;
 }

 // ----CEP---
 public function getCep(): string
 {
  return $this->cep;
 }
 public function setCep(string $cep): void
 {
  $this->cep = $cep;
 }

 // ----USUARIO_ID---
 public function getUsuarioId()
 {
  return $this->usuario_id;
 }
 public function setUsuarioId($usuario_id)
 {
  $this->usuario_id = $usuario_id;
 }

 // ----CIDADE---
 public function getCidade(): string
 {
  return $this->cidade;
 }
 public function setCidade(string $cidade): void
 {
  $this->cidade = $cidade;
 }

 // ----ESTADO---
 public function getEstado(): string
 {
  return $this->estado;
 }
 public function setEstado(string $estado): void
 {
  $this->estado = $estado;
 }

}
