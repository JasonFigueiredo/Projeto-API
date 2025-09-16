<?php

namespace Src\VO;

use Src\_Public\Util;
use Src\VO\EnderecoVO;

class UsuarioVO extends EnderecoVO
{

    private $id;
    private $nome;
    private $tipo;
    private $email;
    private $tel;
    private $senha;
    private $status;
    private $cpf;
   
    

    // get set de ID
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getId(): int
    {
        return $this->id;
    }

    // get set de NOME
    public function setNome(string $nome): void
    {
        $this->nome = Util::TratarDados($nome);
    }
    public function getNome(): string
    {
        return $this->nome;
    }

    // get set de TIPO
    public function setTipo(string $tipo): void
    {
        $this->tipo = Util::TratarDados($tipo);
    }
    public function getTipo(): string
    {
        return $this->tipo;
    }

    // get set de EMAIL
    public function setEmail(string $email): void
    {
        $this->email = Util::RemoverTags($email);
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    // get set de TELEFONE
    public function setTel(string $tel): void
    {
        $this->tel = Util::TirarCaracteresEspeciais($tel);
    }
    public function getTel(): string
    {
        return $this->tel;
    }

    // get set de SENHA
    public function setSenha(?string $senha): void
    {
        $this->senha = $senha ? Util::RemoverTags($senha) : '';
    }
    public function getSenha(): string
    {
        return $this->senha;
    }

    // get e set de STATUS
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    public function getStatus(): string
    {
        return $this->status;
    }

    // get e set de CPF
    public function setCPF(string $cpf): void
    {
        $this->cpf = Util::RemoverTags($cpf);
    }
    public function getCPF(): string
    {
        return $this->cpf;
    }

  

}
