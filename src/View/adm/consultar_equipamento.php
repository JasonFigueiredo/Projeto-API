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
                            <h1>Consultar equipamento</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Menu</a></li>
                                <li class="breadcrumb-item active">Gerenciar modelos</li>
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
                        <h3 class="card-title">Aqui você faz a consulta dos seus equipamentos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="consultar_equipamento.php" method="POST" id="formCad">
                            <div class="form-group">
                                <label for="nomeEquipamento">Pesquisar por tipo</label>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Tipo:</label>
                                        <select class="form-control" id="tipo" name="tipo" onchange="FiltrarEquipamentos()">
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Modelo:</label>
                                        <select class="form-control" id="modelo" name="modelo" onchange="FiltrarEquipamentos()">
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Equipamentos cadastrados</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tableResult" class="table table-bordered table-striped">
                           
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
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

    <script src="../../Resource/ajax/equipamento_ajax.js"></script>
    <script>
        CarregarTipo();
        CarregarModelos();
        FiltrarEquipamentos();
    </script>
</body>

</html>