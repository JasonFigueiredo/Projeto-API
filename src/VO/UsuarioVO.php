<?php

namespace Src\VO;

use Src\_Public\Util;

class UsuarioVO
{

    private $id;
    private $nome;
    private $tipo;
    private $email;
    private $tel;
    private $senha;
    private $status;

    // get set de ID
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // get set de NOME
    public function setNome($nome)
    {
        $this->nome = Util::TratarDados($nome);
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    // get set de TIPO
    public function setTipo($tipo)
    {
        $this->tipo = Util::TratarDados($tipo);
    }
    public function getTipo(): int
    {
        return $this->tipo;
    }

    // get set de EMAIL
    public function setEmail($email): void
    {
        $this->email = Util::RemoverTags($email);
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    // get set de TELEFONE
    public function setTel($tel): void
    {
        $this->tel = Util::TirarCaracteresEspeciais($tel);
    }
    public function getTel(): string
    {
        return $this->tel;
    }

    // get set de SENHA
    public function setSenha($senha): void
    {
        $this->senha = Util::RemoverTags($senha);
    }
    public function getSenha(): string
    {
        return $this->senha;
    }

    // get e set de STATUS
    public function setStatus($status): void
    {
        $this->status = $status;
    }
    public function getStatus(): int
    {
        return $this->status;
    }
}
