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

        // Validações específicas serão feitas no Model

        $usuarioVO->setStatus(SITUACAO_ATIVO);
        // Criptografar senha
        $usuarioVO->setSenha(Util::CriptografarSenha($usuarioVO->getCPF()));
        // Definir função de erro
        $usuarioVO->setFuncaoErro(CADASTRAR_USUARIO);
        $usuarioVO->setCodLogado(Util::CodigoLogado());

        return $this->model->cadastrarUsuarioMODEL($usuarioVO);
    }
    // ----- PASSO 3 "CTRL 08" -----
    public function verificarCpfDuplicadoCTRL($cpf): bool
    {
        return $this->model->verificarCpfDuplicadoMODEL($cpf);
    }

    // ----- PASSO 3 "CTRL 09" -----
    public function filtrarUsuarioCTRL(string $nome): array
    {
        return $this->model->filtrarUsuarioMODEL($nome);
    }
    // ----- PASSO 3 "CTRL 10" -----
    public function AlterarStatusUsuarioCTRL(UsuarioVO $vo): int
    {
        $vo->setFuncaoErro(ALTERAR_STATUS_USUARIO);
        // O status já vem correto do JavaScript, não precisa inverter
        return $this->model->AlterarStatusMODEL($vo);
    }

    // ----- PASSO 3 "CTRL 11" -----
    public function DetalharUsuarioCTRL(int $id): array|int|bool
    {
        if ($id == "" || $id <= 0)
            return 0;

        return $this->model->DetalharUsuarioMODEL($id);
    }

    // ----- PASSO 3 "CTRL 12" -----
    public function AlterarUsuarioCTRL(UsuarioVO $vo, bool $tem_sessao = true): int
    {
        $vo->setFuncaoErro(ALTERAR_USUARIO);
        $vo->setCodLogado($tem_sessao ? Util::CodigoLogado() : $vo->getId());
        return $this->model->AlterarUsuarioMODEL($vo);
    }

    // ----- PASSO 3 "CTRL 13" -----
    public function ValidarLoginCTRL(string $login, string $senha): int
    {
        if (empty($login) || empty($senha))
            return 0;

        $usuario = $this->model->ValidarLoginMODEL($login, SITUACAO_ATIVO);
        if (empty($usuario))
            return 10;
        if (!Util::VerificarSenha($senha, $usuario['senha_usuario']))
            return 10;
        $this->model->RegistrarLogAcesso($usuario['id']);

        Util::CriarSessao($usuario['id'], $usuario['nome_usuario']);
        return 1; // Login bem-sucedido
    }

    public function AlterarSenhaCTRL(UsuarioVO $vo, bool $tem_sessao = true): int
    {
        if (empty($vo->getId()) || empty($vo->getSenha()))
            return 0;

        $vo->setSenha(Util::CriptografarSenha($vo->getSenha()));
        $vo->setCodLogado($tem_sessao ? Util::CodigoLogado() : $vo->getId());
        $vo->setFuncaoErro(ALTERAR_SENHA_USUARIO);

        return $this->model->AlterarSenhaMODEL($vo);
    }

    public function VerificarSenhaCTRL(int $id, string $senha_digitada): int
    {
        $senha_hash = $this->model->BuscarSenhaModel($id);

        if (empty($senha_hash)) {
            return -1;
        }

        // ✅ $senha_hash já é string, não array
        $ret = Util::VerificarSenha($senha_digitada, $senha_hash);
        return $ret ? 1 : -1;
    }
}
