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
    // ----- PASSO 3 "CTRL 02" -----
    public function cadastrarEstadoCTRL($nomeEstado, $siglaEstado): bool
    {
        return $this->model->cadastrarEstadoMODEL($nomeEstado, $siglaEstado);
    }
    // ----- PASSO 3 "CTRL 03" -----
    public function cadastrarCidadeCTRL($nomeCidade, $idEstado): bool
    {
        return $this->model->cadastrarCidadeMODEL($nomeCidade, $idEstado);
    }
    // ----- PASSO 3 "CTRL 03" -----
}
