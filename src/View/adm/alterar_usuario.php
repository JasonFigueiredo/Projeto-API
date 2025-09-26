<?php
use Src\_Public\Util;
use Src\Controller\UsuarioCTRL;

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

// Carregar dados do usuário se houver parâmetro cod
$dados = null;
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $ctrl = new UsuarioCTRL();
    $dados = $ctrl->DetalharUsuarioCTRL($_GET['cod']);
    // Se não encontrou dados, redireciona para consultar usuário
    if (empty($dados)) {
        header('Location: consultar_usuario.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    include_once PATH . "Template/_includes/_head.php";
    ?>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->

        <?php
        include_once PATH . 'Template/_includes/_topo.php';
        include_once PATH . 'Template/_includes/_menu.php'
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Alterar Usuário</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                                <li class="breadcrumb-item active">Alterar Usuário</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header card-primary card-outline">
                        <h3 class="card-title">Dados para alteração</h3>
                    </div>
                    <div class="card-body">
                        <form action="novo_usuario.php" method="post" id="formCad">
                            <input type="hidden" id="id_usuario" name="id_usuario" value="<?= $dados['id'] ?? '' ?>">
                            <!-- Primeira linha: Tipo de usuário e Setor -->
                            <div class="row" id="divPrimeiraLinha">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Escolha o tipo de usuário:</label>
                                        <input type="text" class="form-control obg" disabled 
                                               value="<?= $dados ? Util::MostrarTipoUsuario($dados['tipo_usuario']) : 'Não carregado' ?>">
                                        <input type="hidden" id="tipo" name="tipo" value="<?= $dados['tipo_usuario'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12" id="divUsuarioFuncionario">
                                    <div class="form-group">
                                        <label>Setor:</label>
                                        <select class="form-control obg" id="setor" name="setor">
                                            <option value="">Selecione o setor</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Nome da empresa - visível apenas para técnicos -->
                                <div class="col-lg-6 col-md-6 col-sm-12" id="divUsuarioTecnico" style="display: none;">
                                    <div class="form-group">
                                        <label>Nome da empresa:</label>
                                        <input type="text" class="form-control obg" id="empresa" name="empresa" value="<?= $dados['nome_empresa'] ?? '' ?>" placeholder="Digite o nome da empresa">
                                    </div>
                                </div>
                            </div>

                            <!-- Segunda linha: Nome e CPF -->
                            <div class="row" id="divDadosUsuario">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control obg" id="nome" name="nome" value="<?= $dados['nome_usuario'] ?? '' ?>" placeholder="Digite o nome do usuario">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>CPF:</label>
                                        <input type="text" class="form-control obg" id="cpf" name="cpf" value="<?= $dados['cpf_usuario'] ?? '' ?>" placeholder="000.000.000-00" maxlength="14">
                                    </div>
                                </div>
                            </div>

                            <!-- Terceira linha: Telefone e E-mail -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Telefone:</label>
                                        <input type="text" class="form-control obg" id="tel" name="tel" value="<?= $dados['tel_usuario'] ?? '' ?>" placeholder="Digite o telefone" oninput="formatarTelefone(this)" maxlength="15">
                                        <small class="form-text text-muted">Formato: (ddd) xxxxx-xxxx</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" class="form-control obg" id="email" name="email" value="<?= $dados['email_usuario'] ?? '' ?>" placeholder="digite o e-mail" oninput="formatarEmail('email')" 
                                        onblur="validarEmailCompleto('email')" style="text-transform: lowercase;">
                                    </div>
                                </div>
                            </div>

                            <!-- Dados de endereço -->
                            <div class="row" id="divDadosEndereco">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>CEP:</label>
                                        <input type="text" class="form-control obg" id="cep" name="cep"
                                            value="<?= $dados['cep'] ?? '' ?>"
                                            placeholder="Digite o CEP"
                                            onblur="pesquisacep(this.value)"
                                            maxlength="9"
                                            oninput="formatarCEP(this)">
                                        <small class="form-text text-muted">Formato: 00000-000</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Rua:</label>
                                        <input type="text" class="form-control obg" id="rua" name="rua" value="<?= $dados['rua'] ?? '' ?>" placeholder="Digite a rua">
                                    </div>
                                </div>
                            </div>

                            <!-- Quinta linha: Bairro e Cidade -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Bairro:</label>
                                        <input type="text" maxlength="20" class="form-control obg" id="bairro" name="bairro" value="<?= $dados['bairro'] ?? '' ?>" placeholder="Digite o bairro">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Cidade:</label>
                                        <input disabled maxlength="20" type="text" class="form-control obg" id="cidade" name="cidade" value="<?= $dados['nome_cidade'] ?? '' ?>" placeholder="Digite o CEP (Preenchimento automático)">
                                    </div>
                                </div>
                            </div>

                            <!-- Sexta linha: Estado -->
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <input disabled maxlength="2" type="text" class="form-control obg" id="estado" name="estado" value="<?= $dados['sigla_estado'] ?? '' ?>" placeholder="Digite o CEP (Preenchimento automático)">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button style="display: none;" onclick="AlterarUsuario('formCad')" type="button" class="btn btn-primary" id="btn_cadastrar" name="btn_cadastrar">Alterar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include_once PATH . 'Template/_includes/_footer.php';
        ?>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <?php
    include_once PATH . 'Template/_includes/_scripts.php';
    include_once PATH . 'Template/_includes/_msg.php';
    ?>
    
    <?php if ($dados): ?>
    <script>
    $(document).ready(function() {
        // Mostrar botão alterar
        $('#btn_cadastrar').show();
        
        // Mostrar campos específicos baseado no tipo
        var tipoUsuario = <?= $dados['tipo_usuario'] ?>;
        
        if (tipoUsuario == <?= USUARIO_FUNCIONARIO ?>) {
            $('#divUsuarioFuncionario').show();
            $('#divUsuarioTecnico').hide();
            // Carregar setores e selecionar o correto se houver
            <?php if (!empty($dados['setor_id'])): ?>
            CarregarSetoresSelect();
            setTimeout(function() {
                $('#setor').val(<?= $dados['setor_id'] ?>);
            }, 500);
            <?php endif; ?>
        } else if (tipoUsuario == <?= USUARIO_TECNICO ?>) {
            $('#divUsuarioTecnico').show();
            $('#divUsuarioFuncionario').hide();
        } else {
            // Administrador - esconder campos específicos
            $('#divUsuarioFuncionario').hide();
            $('#divUsuarioTecnico').hide();
        }
    });
    
    // Inicializar validação CPF
    if (document.getElementById('cpf')) {
        inicializarValidacaoCPF('#cpf');
    }
    </script>
    <?php endif; ?>
</body>

</html>