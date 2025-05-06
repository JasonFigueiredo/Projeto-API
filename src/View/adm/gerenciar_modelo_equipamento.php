<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_modelo_equipamento_dataview.php';

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
        <!-- /.navbar --
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
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <form action="gerenciar_modelo_equipamento.php" method="post" id="formCad">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nome do modelo</label>
                                <input type="text" class="form-control obg" id="tipo" name="modelo" placeholder="Digite aqui...">
                            </div>
                            <button onclick="CadastrarModeloEquipamento('formCad')" type="button" class="btn btn-success" id="btn_cadastrar" name="btn_cadastrar">Cadastrar</button>
                        </div>
                    </form>
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
                        <table class="table table-striped table-bordered table-hover" id="tabelaModeloEquipamento">

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
        </div>
        <!-- /.content-wrapper -->
        <?php
        include_once PATH . 'Template/_includes/_footer.php';
        ?>
        <!-- /.control-sidebar -->
    </div>
    <form action="gerenciar_modelo_equipamento.php" method="post" id="formAlt">
        <?php include_once 'modais/excluir.php' ?>
        <?php include_once 'modais/alterar-modelo.php' ?>
    </form>
    <!-- ./wrapper -->
    <?php
    include_once PATH . 'Template/_includes/_scripts.php';
    include_once PATH . 'Template/_includes/_msg.php';
    ?>
    <script src="../../Resource/ajax/modelo_equipamento_ajax.js"></script>
    <script>
        ConsultarModelo();
    </script>
</body>

</html>