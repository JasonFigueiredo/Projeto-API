<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/gerenciar_tipo_equipamento_dataview.php';

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
                            <h1>Gerenciar tipo equipamento</h1>
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
                        <h3 class="card-title">Aqui você gerencia todos os tipos de equipamentos cadastrados</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formCad" method="post" action="gerenciar_tipo_equipamento.php">
                            <div class="form-group">
                                <label>Nome do tipo</label>
                                <input type="text" class="form-control obg" id="tipo" name="tipo" placeholder="Digite aqui...">
                            </div>
                            <button type="button" onclick="return CadastrarTipoEquipamento()" class="btn btn-success" name="btn_cadastrar">Gravar</button>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </section>

            <section class="content">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Tipos de equipamentos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do equipamento</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                for ($i = 0; $i < count($tipos_equipamentos); $i++) { ?>
                                    <tr>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#alterar-tipo" onclick="CarregarTipoEquipamento('<?= $tipos_equipamentos[$i]['id'] ?>','<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Alterar</a>
                                            <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-excluir" onclick="CarregarExcluir('<?= $tipos_equipamentos[$i]['id'] ?>','<?= $tipos_equipamentos[$i]['nome_tipo'] ?>')">Excluir</a>
                                        </td>
                                        <td>
                                            <?= $tipos_equipamentos[$i]['nome_tipo'] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>
            <!-- /.content -->
        </div>

        <form action="gerenciar_tipo_equipamento.php" method="post" id="formAlt">
            <?php include_once 'modais/excluir.php' ?>
            <?php include_once 'modais/alterar-tipo.php' ?>
        </form>
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
    <script src="../../Resource/ajax/tipo_equipamento_ajax.js"></script>
</body>

</html>