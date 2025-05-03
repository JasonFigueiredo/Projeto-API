<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/alocar_equipamento_dataview.php';
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
                            <h1>Alocar equipamento</h1>
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
                        <h3 class="card-title">Aqui você poderá alocar um equipamento ao setor especifico</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="alocar_equipamentos.php" method="post" id="formCad">
                            <div class="form-group">
                                <label>Selecione o equipamento:</label>
                                <select class="form-control obg" id="tipo" name="tipo">
                                    <option value="">Selecione...</option>
                                    <option value="equipamento1">Equipamento 1</option>
                                    <option value="equipamento2">Equipamento 2</option>
                                    <option value="equipamento3">Equipamento 3</option>
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Selecione o setor:</label>
                                <select class="form-control obg" id="tipo" name="setor">
                                    <option value="">Selecione...</option>
                                    <option value="equipamento1">Setor 1</option>
                                    <option value="equipamento2">Setor 2</option>
                                    <option value="equipamento3">Setor 3</option>
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>
                            </div>
                            <button onclick="return NotificarCampos('formCad')" type="submit" class="btn btn-success" name="btn_alocar" id="tipo">Procurar</button>
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
</body>

</html>