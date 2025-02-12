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
                            <h1>Cadastrar equipamentos</h1>
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
                        <h3 class="card-title ">Cadastrar um novo equipamento</h3>

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
                            <label for="nomeEquipamento">Adicionar um equipamento</label>
                            <input type="text" class="form-control" id="nomeEquipamento" name="nomeEquipamento" placeholder="Digite o nome do equipamento">
                        </div>
                        <button type="submit" class="btn btn-success">Adicionar</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </section>

            <section class="content">
                <div class="card">
                    <div class="card-header card-primary card-outline">
                        <h3 class="card-title">Tipos de equipamentos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendernderiging engine: activate to sort column descending" aria-sort="ascending" style="width: 200.250px;">Equipamentos</th>
                                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 199.734px;">Browser</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 7.0</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 7.5</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 8.0</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 8.5</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 9.0</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 9.2</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera 9.5</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Presto</td>
                                                <td>Opera for Wii</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Presto</td>
                                                <td>Nokia N800</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Presto</td>
                                                <td>Nintendo DS browser</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Tasman</td>
                                                <td>Internet Explorer 4.5</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Tasman</td>
                                                <td>Internet Explorer 5.1</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Tasman</td>
                                                <td>Internet Explorer 5.2</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Trident</td>
                                                <td>Internet
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Webkit</td>
                                                <td>OmniWeb 5.5</td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Webkit</td>
                                                <td>iPod Touch / iPhone</td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Webkit</td>
                                                <td>S60</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th rowspan="1" colspan="1">Equipamentos</th>
                                                <th rowspan="1" colspan="1">Browser</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    <!-- ./wrapper -->
    <?php
    include_once PATH . 'Template/_includes/_scripts.php';
    ?>
    <script>
        $(function() {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
</body>

</html>