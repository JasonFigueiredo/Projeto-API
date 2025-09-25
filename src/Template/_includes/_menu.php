<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/ControleOs/src/Template/dist/img/jason.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Jason Figueiredo</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Adicione ícones aos links usando a classe .nav-icon
               com font-awesome ou qualquer outra biblioteca de ícones -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-desktop"></i>
                        <p>
                            Equipamentos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="gerenciar_tipo_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tipo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gerenciar_modelo_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modelos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gerenciar_setor.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setores</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="alocar_equipamentos.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alocar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consultar_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="remover_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Remover</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuários
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="novo_usuario.php" class="nav-link">
                                <i class="fas fa-user-plus nav-icon"></i>
                                <p>Novo usuario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consultar_usuario.php" class="nav-link">
                                <i class="fas fa-search nav-icon"></i>
                                <p>Consultar usuario</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- /.sidebar -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>