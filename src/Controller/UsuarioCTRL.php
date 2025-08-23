<?php

namespace Src\Controller;

use Src\Model\UsuarioMODEL;
use Src\VO\UsuarioVO;
use Src\_Public\Util;

class UsuarioCTRL
{
    private $model;

    public function __construct()
    {
        $this->model = new UsuarioMODEL();
    }
    // ----- PASSO 3 "CTRL 01" -----
    public function verificarEmailDuplicadoCTRL($email): bool
    {
        return $this->model->verificarEmailDuplicadoMODEL($email);
    }
    // ----- PASSO 3 "CTRL 07" -----
    public function cadastrarUsuarioCTRL(UsuarioVO $usuarioVO): int
    {
        if (
            empty($usuarioVO->getNome()) ||
            empty($usuarioVO->getTipo()) ||
            empty($usuarioVO->getCpf()) ||
            empty($usuarioVO->getTel()) ||
            empty($usuarioVO->getEmail()) ||
            empty($usuarioVO->getCidade()) ||
            empty($usuarioVO->getEstado()) ||
            empty($usuarioVO->getRua()) ||
            empty($usuarioVO->getBairro()) ||
            empty($usuarioVO->getCep())
        ) {
            return 0; // Dados obrigatórios não preenchidos
        }

        if ($usuarioVO->getTipo() == USUARIO_TECNICO && empty($usuarioVO->getNomeEmpresa()))
            return 0; // Nome da empresa é obrigatório para técnicos
        if ($usuarioVO->getTipo() == USUARIO_FUNCIONARIO && empty($usuarioVO->getIdSetor()))
            return 0; // Setor é obrigatório para funcionários

        $usuarioVO->setStatus(SITUACAO_ATIVO);
        // Criptografar senha
        $usuarioVO->setSenha(Util::CriptografarSenha($usuarioVO->getCPF()));
        // Definir função de erro
        $usuarioVO->setFuncaoErro(CADASTRAR_USUARIO);
        $usuarioVO->setCodLogado(Util::CodigoLogado());

        return $this->model->cadastrarUsuarioMODEL($usuarioVO);
    }
}
