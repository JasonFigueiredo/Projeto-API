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

    public function verificarEmailDuplicadoCTRL($email): bool
    {
        return $this->model->verificarEmailDuplicadoMODEL($email);
    }
}
