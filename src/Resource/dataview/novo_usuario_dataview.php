<?php

use Src\Controller\UsuarioCTRL;
use Src\VO\UsuarioVO;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

$ctrl = new UsuarioCTRL();

if (isset($_POST['verificar_email_duplicado'])) {
  echo $ctrl->verificarEmailDuplicadoCTRL($_POST['email']);
}