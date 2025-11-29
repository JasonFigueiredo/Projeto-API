<?php

namespace Src\Resource\api\Classe;

use Src\Controller\UsuarioCTRL;
use Src\Resource\api\Classe\ApiRequest;

class FuncionarioEndPoints extends ApiRequest
{
   private $params;

   public function AddParameters($p)
   {
      $this->params = $p;
   }

   public function CheckEndPoint($endpoint) {
      return method_exists($this, $endpoint);
   }
    
   public function DetalharUsuarioAPI(){

      $objCTRL = new UsuarioCTRL();
      $dados_usario = $objCTRL->DetalharUsuarioCTRL($this->params['id_user']);
      return $dados_usario;
   }
}