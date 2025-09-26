<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/novo_usuario_dataview.php';
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
                            <h1>Novo usuario</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                                <li class="breadcrumb-item active">Pagina Inicial</li>
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
                        <h3 class="card-title">Dados para cadastro</h3>
                    </div>
                    <div class="card-body">
                        <form action="novo_usuario.php" method="post" id="formCad">
                            <div class="row">
                                <!-- Tipo de usuário - sempre visível -->
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Escolha o tipo de usuário:</label>
                                        <select class="form-control obg" id="tipo" name="tipo" onchange="CarregarCamposUsuario(this.value)">
                                            <option value="">Selecione...</option>
                                            <option value="<?= USUARIO_ADM ?>">Administrador</option>
                                            <option value="<?= USUARIO_FUNCIONARIO ?>">Funcionário</option>
                                            <option value="<?= USUARIO_TECNICO ?>">Técnico</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Setor - visível apenas para funcionários -->
                                <div class="col-lg-6 col-md-6 col-sm-12" id="divUsuarioFuncionario" style="display: none;">
                                    <div class="form-group">
                                        <label>Setor:</label>
                                        <select class="form-control obg" id="setor" name="setor">
                                            <option value="">Selecione</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Nome da empresa - visível apenas para técnicos -->
                                <div class="col-lg-6 col-md-6 col-sm-12" id="divUsuarioTecnico" style="display: none;">
                                    <div class="form-group">
                                        <label>Nome da empresa:</label>
                                        <input type="text" class="form-control obg" id="empresa" name="empresa" placeholder="Digite o nome da empresa">
                                    </div>
                                </div>
                            </div>

                            <!-- Dados do usuário - visível após seleção do tipo -->
                            <div class="row" id="divDadosUsuario" style="display: none;">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Nome:</label>
                                        <input type="text" class="form-control obg" id="nome" name="nome" placeholder="Digite o nome do usuario">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>CPF:</label>
                                        <input type="text" class="form-control obg" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Telefone:</label>
                                        <input type="text" class="form-control obg" id="tel" name="tel" placeholder="Digite o telefone" oninput="formatarTelefone(this)" maxlength="15">
                                        <small class="form-text text-muted">Formato: (ddd) xxxxx-xxxx</small>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>E-mail:</label>
                                        <input type="email" class="form-control obg" id="email" name="email" placeholder="Digite o E-mail" oninput="formatarEmail('email')" 
                                        onblur="validarEmailCompleto('email')" style="text-transform: lowercase;">
                                    </div>
                                </div>
                            </div>

                            <!-- Dados de endereço -->
                            <div class="row" id="divDadosEndereco" style="display: none;">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>CEP:</label>
                                        <input type="text" class="form-control obg" id="cep" name="cep"
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
                                        <input type="text" class="form-control obg" id="rua" name="rua" placeholder="Digite a rua">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Bairro:</label>
                                        <input type="text" maxlength="20" class="form-control obg" id="bairro" name="bairro" placeholder="Digite o bairro">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Cidade:</label>
                                        <input disabled maxlength="20" type="text" class="form-control obg" id="cidade" name="cidade" placeholder="Digite o CEP (Preenchimento automático)">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Estado:</label>
                                        <input disabled maxlength="2" type="text" class="form-control obg" id="estado" name="estado" placeholder="Digite o CEP (Preenchimento automático)">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <button style="display: none;" onclick="CadastrarUsuario('formCad')" type="button" class="btn btn-success" id="btn_cadastrar" name="btn_cadastrar">Gravar</button>
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
    
    <script>
    // Inicializar validação CPF
    $(document).ready(function () {
        if (document.getElementById('cpf')) {
            inicializarValidacaoCPF('#cpf');
        }
    });
    </script>
</body>

</html>