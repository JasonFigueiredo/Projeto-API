<?php

    namespace Src\VO;

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

        public function getId(){
            return $this->id;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }  

        public function getTipo(){
            return $this->tipo;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setTel($tel){
            $this->tel = $tel;
        }

        public function getTel(){
            return $this->tel;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setStatus($status){
            $this->status = $status;
        }

        public function getStatus(){
            return $this->status;
        }
    }
