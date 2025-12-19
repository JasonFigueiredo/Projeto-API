<?php

namespace Src\Resource\api\Classe;

use Src\Controller\UsuarioCTRL;
use Src\Resource\api\Classe\ApiRequest;
use Src\VO\FuncionarioVO;
use Src\VO\UsuarioVO;

class FuncionarioEndPoints extends ApiRequest
{
   private $ctrl_user;

   public function __construct()
   {
      $this->ctrl_user = new UsuarioCTRL();
   }

   private $params;

   public function AddParameters($p)
   {
      $this->params = $p;
   }

   public function VerificarSenhaAPI(){
      return $this->ctrl_user-> VerificarSenhaCTRL($this->params['id_user'], $this->params['senha_digitada']);
   }

   public function CheckEndPoint($endpoint)
   {
      return method_exists($this, $endpoint);
   }

   public function DetalharUsuarioAPI()
   {

      $dados_usario = $this->ctrl_user->DetalharUsuarioCTRL($this->params['id_user']);
      return $dados_usario;

   }

   public function AlterarSenhaAPI(){
      $vo = new UsuarioVO() ;

      $vo->setId($this->params['cod_usuario']);
      $vo->setSenha($this->params['nova_senha']);

      return $this->ctrl_user->AlterarSenhaCTRL($vo);
   }

   public function AlterarMeusDadosAPI(): int
   {
      $vo = new FuncionarioVO();
      // Dados do funcionário
      $vo->setIdSetor($this->params['setor']);
      // DADOS DO USUÁRIO
      $vo->setId($this->params['cod_usuario']);

      $vo->setTipo($this->params['tipo']);
      $vo->setNome($this->params['nome']);
      $vo->setEmail($this->params['email']);
      $vo->setCPF($this->params['cpf']);
      $vo->setTel($this->params['tel']);
      //dados do endereço
      $vo->setRua($this->params['rua']);
      $vo->setBairro($this->params['bairro']);
      $vo->setCep($this->params['cep']);
      $vo->setCidade($this->params['cidade']);
      $vo->setEstado($this->params['estado']);

      $ret = $this->ctrl_user->AlterarUsuarioCTRL($vo, false);

      return $ret;
   }
}