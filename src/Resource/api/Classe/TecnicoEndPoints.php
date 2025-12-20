<?php

namespace Src\Resource\api\Classe;

use Src\Controller\ChamadoCTRL;
use Src\Controller\UsuarioCTRL;
use Src\Controller\NovoEquipamentoCTRL;
use Src\Resource\api\Classe\ApiRequest;
use Src\VO\TecnicoVO;  // ✅ Usar TecnicoVO ao invés de FuncionarioVO
use Src\VO\ChamadoVO;
use Src\VO\UsuarioVO;


class TecnicoEndPoints extends ApiRequest
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
      $vo = new TecnicoVO();  // ✅ Usar TecnicoVO para técnicos
      // Dados do técnico
      $vo->setNomeEmpresa($this->params['empresa']);  // ✅ Nome da empresa
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

   public function ListarEquipamentosAlocadosSetorAPI()
   {
      return (new NovoEquipamentoCTRL)->ListarEquipamentosAlocadosSetorCTRL($this->params['setor_id']);
   }

   public function AbrirChamadoAPI(): int
   {
      $vo = new ChamadoVO();
      $vo->setIdAlocar($this->params['alocar_id']);
      $vo->setIdFuncionario($this->params['func_id']);
      $vo->setProblema($this->params['problema']);

      return (new ChamadoCTRL)->AbrirChamadoCTRL($vo,false);
   }

   public function FiltrarChamadosAPI()
   {
      return (new ChamadoCTRL)->FiltrarChamadosCTRL(
         $this->params['situacao'],
         $this->params['setor_id']
      );
   }

   public function AtenderChamadoAPI(): int
   {
      $vo = new ChamadoVO();
      $vo->setId($this->params['chamado_id']);
      $vo->setDataAtendimento($this->params['data_atendimento']);
      $vo->setHoraAtendimento($this->params['hora_atendimento']);
      $vo->setIdTecnicoAtendimento($this->params['tecnico_id']);

      return (new ChamadoCTRL)->AtenderChamadoCTRL($vo);
   }

   public function FinalizarChamadoAPI(): int
   {
      $vo = new ChamadoVO();
      $vo->setId($this->params['chamado_id']);
      $vo->setDataEncerramento($this->params['data_encerramento']);
      $vo->setHoraEncerramento($this->params['hora_encerramento']);
      $vo->setTecnicoEncerramentoId($this->params['tecnico_id']);
      $vo->setLaudo($this->params['laudo']);
      $vo->setIdAlocar($this->params['alocar_id']);

      return (new ChamadoCTRL)->FinalizarChamadoCTRL($vo);
   }
}