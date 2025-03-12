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
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Equipamentos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="novo_usuario.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo usuario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="novo_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Novo equipamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gerenciar_modelo_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gerenciar modelo</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="gerenciar_tipo_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gerenciar equipamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="alocar_equipamentos.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alocar equipamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consultar_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar equipamento</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="consultar_usuario.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar usuario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="remover_equipamento.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Remover equipamento</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- Sctipt para que o menu fique selecionado quando o usuario clicar em algum tópico  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                navLinks.forEach(function(nav) {
                    nav.classList.remove('active');
                });
                this.classList.add('active');
            });
        });
    });
</script>