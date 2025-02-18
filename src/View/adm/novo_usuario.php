<?php
include_once dirname(__DIR__, 3) . '/vendor/autoload.php';
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
                        <h3 class="card-title">Aqui você insere um novo usuario</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="equipamento">Tipo:</label>
                                <select class="form-control" id="equipamento" name="equipamento">
                                    <option value="">Selecione...</option>
                                    <option value="equipamento1">Equipamento 1</option>
                                    <option value="equipamento2">Equipamento 2</option>
                                    <option value="equipamento3">Equipamento 3</option>
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>
                            </div>
                        </form>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="equipamento">Setor:</label>
                                <select class="form-control" id="equipamento" name="equipamento">
                                    <option value="">Selecione...</option>
                                    <option value="equipamento1">Setor 1</option>
                                    <option value="equipamento2">Setor 2</option>
                                    <option value="equipamento3">Setor 3</option>
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>
                            </div>
                        </form>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="identificacao">Nome:</label>
                                <input type="text" class="form-control" id="identificacao" name="identificacao" placeholder="Digite a identificação" required>
                            </div>
                        </form>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="sobrenome">Sobrenome:</label>
                                <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="Digite o nome" required>
                            </div>
                        </form>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Digite o E-mail" required>
                            </div>
                        </form>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="telefone">Telefone:</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Digite o telefone" required pattern="\(\d{2}\) \d{5}-\d{4}">
                                <small class="form-text text-muted">Formato: (ddd) xxxxx-xxxx</small>
                            </div>
                        </form>
                        <script>
                            // script para formatar o telefone e adicionar máscara
                            document.getElementById('telefone').addEventListener('input', function(e) {
                                var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                                e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                            });
                        </script>
                        <form action="novo_usuario.php" method="post">
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Digite a endereço" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Gravar</button>
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
    ?>
</body>

</html>