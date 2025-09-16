 <?php

  use Src\_Public\Util;
  use Src\Controller\UsuarioCTRL;
  use Src\VO\UsuarioVO;
  use Src\VO\FuncionarioVO;
  use Src\VO\TecnicoVO;

  include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

  $ctrl = new UsuarioCTRL();

  if (isset($_POST['verificar_email_duplicado'])) {
    $emailDuplicado = $ctrl->verificarEmailDuplicadoCTRL($_POST['email']);
    echo $emailDuplicado ? 'true' : 'false';
    exit;
  } else if (isset($_POST['verificar_cpf_duplicado'])) {
    $cpfDuplicado = $ctrl->verificarCpfDuplicadoCTRL($_POST['cpf']);
    echo $cpfDuplicado ? 'true' : 'false';
    exit;
  } else if (isset($_POST['btn_cadastrar'])) {

    switch ($_POST['tipo']) {
      case USUARIO_ADM:
        //Util::MostrarDadosArray('USUARIO_ADM');
        $vo = new UsuarioVO();
        //DADOS DO USUARIO/ADM
        break;

      case USUARIO_TECNICO:
        // Util::MostrarDadosArray('USUARIO_TECNICO');
        $vo = new TecnicoVO();
        // O perfil do tecnico esta dentro de FuncionarioVO
        //DADOS DO TECNICO
        $vo->setNomeEmpresa($_POST['empresa']);
        break;

      case USUARIO_FUNCIONARIO:
        // Util::MostrarDadosArray('USUARIO_FUNCIONARIO');
        $vo = new FuncionarioVO();
        //DADOS DO FUNCIONARIO
        $vo->setIdSetor($_POST['setor']);
        break;
    }
    //DADOS COMUNS A TODOS OS PERFIS
    $vo->setTipo($_POST['tipo']);
    $vo->setNome($_POST['nome']);
    $vo->setEmail($_POST['email']);
    $vo->setCPF($_POST['cpf']);
    $vo->setTel($_POST['tel']);

    //dados do endereço
    $vo->setRua($_POST['rua']);
    $vo->setBairro($_POST['bairro']);
    $vo->setCep($_POST['cep']);
    $vo->setCidade($_POST['cidade']);
    $vo->setEstado($_POST['estado']);

    $ret = $ctrl->cadastrarUsuarioCTRL($vo);
    echo $ret;
  } else if (isset($_POST['filtrar_usuario'])) {
    $usuarios_encontrados = $ctrl->filtrarUsuarioCTRL($_POST['nome_filtro']); 
    
    if(count($usuarios_encontrados) == 0)
      echo 0;
    else {
    ?>

   <table id="tableResult" class="table table-bordered table-striped">
     <thead>
       <tr>
         <th>Ação</th>
         <th>Nome do usuario</th>
         <th>Tipo de usuario</th>
       </tr>
     </thead>
     <tbody>
       <?php foreach ($usuarios_encontrados as $item) { ?>
         <tr>
           <td>
             <a href="#" class=" btn btn-warning btn-xs">Alterar</a>
             <a href="#" class=" btn btn-danger btn-xs">Excluir</a>
           </td>
           <td><?= $item['nome_usuario'] ?></td>
           <td><?= Util::MostrarTipoUsuario($item['tipo_usuario']) ?></td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
 <?php } } ?>