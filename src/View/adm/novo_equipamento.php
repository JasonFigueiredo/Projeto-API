<?php
include_once dirname(__DIR__, 2) . '/Resource/dataview/novo_equipamento_dataview.php';
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
                            <h1>Novo equipamento</h1>
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
                <!-- Defalt box -->
                <div class="card">
                    <div class="card-header card-primary card-outline">
                        <h3 class="card-title">Aqui você poderá cadastrar seus equipamentos</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="formCad" action="novo_equipamento.php" method="post">
                            <div class="form-group">
                                <label>Tipo:</label>
                                <select class="form-control obg" id="tipo" name="tipo">
<!-- visualização do SELECT sera inserido atravez do dataView -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Modelo:</label>
                                <select class="form-control obg" id="modelo" name="modelo">
                                    <option value="">Selecione...</option>
                                    <option value="1">Modelo 1</option>
                                    <option value="2">Modelo 2</option>
                                    <option value="3">Modelo 3</option>
                                    <!-- Adicione mais opções conforme necessário -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identificação:</label>
                                <input type="text" class="form-control obg" id="identificacao" name="identificacao" placeholder="Digite a identificação">
                            </div>
                            <div class="form-group">
                                <label>Observações:</label>
                                <textarea class="form-control obg" id="descricao" name="descricao" rows="4" maxlength="150" placeholder="Digite suas observações" onkeyup="countChars(this)"></textarea>
                                <small id="charCount" class="form-text text-muted">150 caracteres restantes</small>
                            </div>
                            <button onclick="return NotificarCampos('formCad')" type="submit" class="btn btn-success" name="btn_cadastrar">Cadastrar</button>
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
