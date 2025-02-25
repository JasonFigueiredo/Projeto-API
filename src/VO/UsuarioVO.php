<?php

    namespace Src\VO;

    use Src\_Public\Util;

    class UsuarioVO{

        private $id;
        private $nome;
        private $tipo;
        private $email;
        private $tel;
        private $senha;
        private $status;

        // get e set geral dos itens em private UsuarioVO
        public function setId($id){
            $this->id = $id;
        }

        public function getId() : int{
            return $this->id;
        }

        public function setNome($nome){
            $this->nome = Util::TratarDados($nome);
        }

        public function getNome() : string{
            return $this->nome;
        }

        public function setTipo($tipo){
            $this->tipo = Util::TratarDados($tipo);
        }  

        public function getTipo() : int{
            return $this->tipo;
        }

        public function setEmail($email) : void{
            $this->email = Util::RemoverTags($email);
        }

        public function getEmail() : string{
            return $this->email;
        }

        public function setTel($tel){
            $this->tel = Util::TratarDados($tel);
        }

        public function getTel() : string{
            return $this->tel;
        }

        public function setSenha($senha) : void{
            $this->senha = Util::RemoverTags($senha);
        }

        public function getSenha() : string{
            return $this->senha;
        }

        public function setStatus($status) : void{
            $this->status = $status;
        }

        public function getStatus() : int{
            return $this->status;
        }
    }
