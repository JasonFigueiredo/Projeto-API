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
                    <div class="row mb-2 ">
                        <div class="col-sm-6 ">
                            <h1>Gerenciar modelo de equipamento</h1>
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
                        <h3 class="card-title ">Aqui você pode gerenciar todos os modelos de equipamentos cadastrados</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nomeEquipamento">Nome do modelo</label>
                            <input type="text" class="form-control" id="nomeEquipamento" name="nomeEquipamento" placeholder="Digite aqui...">
                        </div>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Modelos cadastrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do modelo</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Notebook</td>
                                    <td>
                                        <a href="#" class=" btn btn-warning btn-xs">Alterar</a>
                                        <a href="#" class=" btn btn-danger btn-xs">Excluir</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <!-- /.content-wrapper -->
            <!-- /.control-sidebar -->
        </div>
        <?php
        include_once PATH . 'Template/_includes/_footer.php';
        ?>
        <!-- ./wrapper -->
        <?php
        include_once PATH . 'Template/_includes/_scripts.php';
        ?>
    </div>
</body>

</html>