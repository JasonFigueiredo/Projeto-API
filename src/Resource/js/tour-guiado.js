/**
 * Sistema de Tour Guiado para Controle de Chamados
 * Versão: 1.0
 * Autor: Sistema ControleOS
 */

class TourGuiado {
    constructor() {
        this.passos = [];
        this.passoAtual = 0;
        this.overlay = null;
        this.tooltip = null;
        this.isActive = false;
        this.config = {
            corDestaque: '#28a745',
            corOverlay: 'rgba(0, 0, 0, 0.7)',
            duracaoAnimacao: 150
        };

        this.init();
    }

    init() {
        this.criarOverlay();
        this.criarTooltip();
        this.carregarConfiguracao();
        this.adicionarBotaoIniciar();
        this.verificarEstadoTour();
    }

    verificarEstadoTour() {
        // Verificar se estamos na página de login
        const currentPath = window.location.pathname;
        const isLoginPage = currentPath.includes('login.php') || currentPath.includes('acesso');
        
        if (isLoginPage) {
            console.log('🔒 DEBUG: Página de login detectada, não retomando tour');
            return;
        }

        // Verificar se há um tour ativo em andamento
        const tourAtivo = sessionStorage.getItem('tourAtivo');
        const passoAtual = sessionStorage.getItem('tourPassoAtual');

        console.log(`🔍 DEBUG: Verificando estado do tour - Ativo: ${tourAtivo}, Passo: ${passoAtual}`);

        if (tourAtivo === 'true' && passoAtual) {
            this.isActive = true;
            this.passoAtual = parseInt(passoAtual);
            this.overlay.style.pointerEvents = 'auto';
            this.mostrarOverlay();

            console.log(`🔄 DEBUG: Retomando tour do passo ${this.passoAtual + 1}`);

            // Aguardar o carregamento da página antes de executar o passo
            this.aguardarCarregamentoPagina().then(() => {
                console.log(`✅ DEBUG: Página carregada, executando passo ${this.passoAtual + 1}`);
                setTimeout(() => {
                    this.executarPasso();
                }, 300); // Delay adicional para garantir que tudo está carregado
            });
        }
    }

    criarOverlay() {
        this.overlay = document.createElement('div');
        this.overlay.className = 'tour-overlay';
        this.overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: transparent;
            z-index: 9998;
            opacity: 0;
            transition: opacity ${this.config.duracaoAnimacao}ms ease;
            pointer-events: none;
            backdrop-filter: none;
        `;
        document.body.appendChild(this.overlay);
    }

    criarTooltip() {
        this.tooltip = document.createElement('div');
        this.tooltip.className = 'tour-tooltip';
        // Remover CSS inline para usar apenas o CSS do arquivo
        // this.tooltip.style.cssText = `...`; // Removido

        this.tooltip.innerHTML = `
            <div class="tour-tooltip-header">
                <h4 class="tour-tooltip-title">Título do Passo</h4>
                <button type="button" class="tour-close" onclick="tourGuiado.fecharTour()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="tour-tooltip-body">
                <p class="tour-tooltip-text">Descrição do passo atual...</p>
            </div>
            <div class="tour-tooltip-footer">
                <div class="tour-progress">
                    <span class="tour-progress-text">1 de 10</span>
                    <div class="tour-progress-bar">
                        <div class="tour-progress-fill"></div>
                    </div>
                </div>
                <div class="tour-buttons">
                    <button type="button" class="btn btn-secondary btn-sm tour-pular" onclick="tourGuiado.pularTour()">
                        Pular Tour
                    </button>
                    <button type="button" class="btn btn-info btn-sm tour-anterior" onclick="tourGuiado.passoAnterior()" style="display: none;">
                        Anterior
                    </button>
                    <button type="button" class="btn btn-success btn-sm tour-proximo" onclick="tourGuiado.proximoPasso()">
                        Próximo
                    </button>
                </div>
            </div>
        `;

        document.body.appendChild(this.tooltip);

        // Debug: Verificar se tooltip foi criado
        console.log('🔍 DEBUG: Tooltip criado e adicionado ao DOM');
        console.log('🔍 DEBUG: Tooltip element:', this.tooltip);
        console.log('🔍 DEBUG: Tooltip classes:', this.tooltip.className);
    }

    adicionarBotaoIniciar() {
        // Verificar se já existe um botão de tour
        if (document.querySelector('.tour-iniciar-btn')) {
            return;
        }

        // Procurar pelo elemento "Menu" no topo
        const menuLink = document.querySelector('.navbar-nav .nav-link[href*="index3.html"]');
        if (menuLink) {
            // Criar o botão diretamente como um li com estrutura correta
            const botaoTour = document.createElement('li');
            botaoTour.className = 'nav-item d-none d-sm-inline-block';
            botaoTour.style.display = 'inline-block';
            botaoTour.style.marginLeft = '10px';

            const botao = document.createElement('button');
            botao.className = 'btn tour-iniciar-btn';
            botao.innerHTML = '<i class="fas fa-play"></i> Iniciar Tour';
            botao.onclick = () => this.iniciarTour();

            botaoTour.appendChild(botao);

            // Inserir após o link do menu
            menuLink.parentNode.insertAdjacentElement('afterend', botaoTour);
        } else {
            console.warn('Elemento do menu não encontrado para adicionar botão de tour');
        }
    }

    carregarConfiguracao() {
        // Configuração dos passos do tour conforme especificado
        this.passos = [
            // Seção Equipamentos
            {
                // passo 0:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: '.sidebar',
                titulo: 'Menu de Navegação',
                descricao: 'Bem-vindo ao sistema de controle de chamados! Este é o menu principal onde você encontrará todas as funcionalidades organizadas por categorias. Vamos começar explorando a seção de Equipamentos.',
                posicao: 'right'
            },
            {
                //-------------------- passo 1:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Tipos de Equipamento',
                descricao: 'Aqui você define os tipos de equipamentos. Isso ajuda na categorização e organização dos equipamentos.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 2:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: 'input[type="text"], input[name*="nome"], input[placeholder*="Digite"]',
                titulo: 'Campo de Input',
                descricao: 'Aqui você deve digitar o nome do tipo de equipamento que deseja cadastrar (ex: Computador, Notebook, Impressora).',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 3:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: 'button[type="submit"], .btn-success, button[value*="Gravar"], button[value*="Salvar"]',
                titulo: 'Botão Gravar',
                descricao: 'Clique neste botão para salvar o tipo de equipamento que você digitou.',
                posicao: 'right'
            },
            {
                // passo complemento 3 passo 4:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: 'tbody tr, .list-group-item, .table tbody tr',
                titulo: 'Nome de Equipamento',
                descricao: 'Aqui aparecerão todos os tipos de equipamentos que você cadastrou.',
                posicao: 'bottom'
            },
            {
                // passo complemento 4 passo 5:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: '.btn-warning, button[value*="Alterar"], button[title*="Alterar"]',
                titulo: 'Botão Alterar',
                descricao: 'Use este botão para modificar um tipo de equipamento existente.',
                posicao: 'right'
            },
            {
                // passo complemento 5 passo 6:
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: '.btn-danger, button[value*="Excluir"], button[title*="Excluir"]',
                titulo: 'Botão Excluir',
                descricao: 'Use este botão para remover um tipo de equipamento da lista.',
                posicao: 'right'
            },
            {
                //-------------------- passo 7:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Modelos de Equipamento',
                descricao: 'Esta tela permite cadastrar e gerenciar os modelos específicos de equipamentos.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 8:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: 'input[type="text"], input[name*="nome"], input[placeholder*="Digite"]',
                titulo: 'Campo de Input',
                descricao: 'Aqui você deve digitar o nome do modelo de equipamento que deseja cadastrar (ex: Dell Optiplex 7090, HP LaserJet Pro).',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 9:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: 'button[type="submit"], .btn-success, button[value*="Gravar"], button[value*="Salvar"]',
                titulo: 'Botão Gravar',
                descricao: 'Clique neste botão para salvar o modelo de equipamento que você digitou.',
                posicao: 'right'
            },
            {
                // passo complemento 3 passo 10:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: 'tbody tr, .list-group-item, .table tbody tr',
                titulo: 'Nome de Equipamento',
                descricao: 'Aqui aparecerão todos os modelos de equipamentos que você cadastrou.',
                posicao: 'bottom'
            },
            {
                // passo complemento 4 passo 11:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: '.btn-warning, button[value*="Alterar"], button[title*="Alterar"]',
                titulo: 'Botão Alterar',
                descricao: 'Use este botão para modificar um modelo de equipamento existente.',
                posicao: 'right'
            },
            {
                // passo complemento 5 passo 12:
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: '.btn-danger, button[value*="Excluir"], button[title*="Excluir"]',
                titulo: 'Botão Excluir',
                descricao: 'Use este botão para remover um modelo de equipamento da lista.',
                posicao: 'right'
            },
            {
                // -------------------- passo 13:
                pagina: 'equipamento.php',
                elemento: '.card-header',
                titulo: 'Cadastro de Equipamentos',
                descricao: 'Aqui você pode cadastrar novos equipamentos no sistema. Preencha todos os campos obrigatórios como nome, modelo, tipo e localização do equipamento.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 14:
                pagina: 'equipamento.php',
                elemento: 'select[name="tipo"], select[id="tipo"]',
                titulo: 'Selecionar Tipo de Equipamento',
                descricao: 'Aqui você deve selecionar o tipo de equipamento que deseja cadastrar (ex: Computador, Notebook, Impressora).',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 15:
                pagina: 'equipamento.php',
                elemento: 'select[name="modelo"], select[id="modelo"]',
                titulo: 'Selecionar Modelo de Equipamento',
                descricao: 'Aqui você deve selecionar o modelo específico do equipamento (ex: Dell Optiplex 7090, HP LaserJet Pro).',
                posicao: 'bottom'
            },
            {
                // passo complemento 3 passo 16:
                pagina: 'equipamento.php',
                elemento: 'input[name="identificacao"], input[id="identificacao"]',
                titulo: 'Identificação do Equipamento',
                descricao: 'Aqui você deve digitar a identificação única do equipamento (número de patrimônio, serial, etc.).',
                posicao: 'bottom'
            },
            {
                // passo complemento 4 passo 17:
                pagina: 'equipamento.php',
                elemento: 'textarea[name="descricao"], textarea[id="descricao"], textarea[placeholder*="observações"]',
                titulo: 'Observações sobre o Equipamento',
                descricao: 'Aqui você pode adicionar observações importantes sobre o equipamento (opcional).',
                posicao: 'bottom'
            },
            {
                // passo complemento 5 passo 18:
                pagina: 'equipamento.php',
                elemento: 'button[name="btn_cadastrar"], .btn-success',
                titulo: 'Cadastrar Equipamento',
                descricao: 'Clique neste botão para cadastrar o equipamento com todas as informações preenchidas.',
                posicao: 'right'
            },
            {
                // -------------------- passo 19:
                pagina: 'gerenciar_setor.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Setores',
                descricao: 'Esta tela permite criar e gerenciar os setores da empresa. Os setores são importantes para organizar os equipamentos por departamento ou área de trabalho.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 20:
                pagina: 'gerenciar_setor.php',
                elemento: 'input[type="text"], input[name*="nome"], input[placeholder*="Digite"]',
                titulo: 'Campo de Input',
                descricao: 'Aqui você deve digitar o nome do setor que deseja cadastrar (ex: Setor de Informática, Setor de Contabilidade).',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 21:
                pagina: 'gerenciar_setor.php',
                elemento: 'button[type="submit"], .btn-success, button[value*="Gravar"], button[value*="Salvar"]',
                titulo: 'Botão Gravar',
                descricao: 'Clique neste botão para salvar o setor que você digitou.',
                posicao: 'right'
            },
            {
                // passo complemento 3 passo 22:
                pagina: 'gerenciar_setor.php',
                elemento: 'tbody tr, .list-group-item, .table tbody tr',
                titulo: 'Nome de Setor',
                descricao: 'Aqui aparecerão todos os setores que você cadastrou.',
                posicao: 'bottom'
            },
            {
                // passo complemento 4 passo 23:
                pagina: 'gerenciar_setor.php',
                elemento: '.btn-warning, button[value*="Alterar"], button[title*="Alterar"]',
                titulo: 'Botão Alterar',
                descricao: 'Use este botão para modificar um setor existente.',
                posicao: 'right'
            },
            {
                // passo complemento 5 passo 24:
                pagina: 'gerenciar_setor.php',
                elemento: '.btn-danger, button[value*="Excluir"], button[title*="Excluir"]',
                titulo: 'Botão Excluir',
                descricao: 'Use este botão para remover um setor da lista.',
                posicao: 'right'
            },
            {
                // -------------------- passo 25:
                pagina: 'alocar_equipamentos.php',
                elemento: '.card-header',
                titulo: 'Alocar Equipamentos',
                descricao: 'Aqui você pode alocar equipamentos para usuários específicos ou setores. Esta funcionalidade ajuda no controle de quem está usando cada equipamento.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 26:
                pagina: 'alocar_equipamentos.php',
                elemento: 'select[name="setor"], select[id="setor"]',
                titulo: 'Selecionar Setor',
                descricao: 'Aqui você deve selecionar o setor que deseja alocar o equipamento.',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 27:
                pagina: 'alocar_equipamentos.php',
                elemento: 'select[name="equipamento"], select[id="equipamento"]',
                titulo: 'Selecionar Equipamento',
                descricao: 'Aqui você deve selecionar o equipamento que deseja alocar.',
                posicao: 'bottom'
            },
            {
                // passo complemento 3 passo 28:
                pagina: 'alocar_equipamentos.php',
                elemento: 'button[name="btn_cadastrar"], .btn-success',
                titulo: 'Botão Alocar',
                descricao: 'Clique neste botão para alocar o equipamento ao setor selecionado.',
                posicao: 'right'
            },
            {
                // -------------------- passo 29:
                pagina: 'consultar_equipamento.php',
                elemento: '.card-header',
                titulo: 'Consultar Equipamentos',
                descricao: 'Esta tela permite visualizar todos os equipamentos cadastrados no sistema, com opções de filtro e busca para encontrar equipamentos específicos.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 30:
                pagina: 'consultar_equipamento.php',
                elemento: 'select[name="tipo"], select[id="tipo"]',
                titulo: 'Selecionar Tipo de Equipamento',
                descricao: 'Aqui você deve selecionar o tipo de equipamento que deseja consultar (ex: Computador, Notebook, Impressora).',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 31:
                pagina: 'consultar_equipamento.php',
                elemento: 'select[name="modelo"], select[id="modelo"]',
                titulo: 'Selecionar Modelo de Equipamento',
                descricao: 'Aqui você deve selecionar o modelo específico do equipamento (ex: Dell Optiplex 7090, HP LaserJet Pro).',
                posicao: 'bottom'
            },
            {
                // passo complemento 3 passo 32:
                pagina: 'consultar_equipamento.php',
                elemento: 'tbody tr, .list-group-item, .table tbody tr',
                titulo: 'Lista de Equipamentos',
                descricao: 'Aqui aparecerão todos os equipamentos que você consultou. Nome do equipamento, modelo, identificação, descrição, situação.',
                posicao: 'bottom'
            },
            {
                // passo complemento 4 passo 33:
                pagina: 'consultar_equipamento.php',
                elemento: '.btn-warning, button[value*="Alterar"], button[title*="Alterar"]',
                titulo: 'Botão Alterar',
                descricao: 'Use este botão para modificar um equipamento existente.',
                posicao: 'right'
            },
            {
                // passo complemento 5 passo 34:
                pagina: 'consultar_equipamento.php',
                elemento: 'a[onclick*="CarregarDescarte"], .btn-danger[data-target="#modal-descarte"]',
                titulo: 'Botão Descarte',
                descricao: 'Use este botão para descartar um equipamento da lista.',
                posicao: 'right'
            },
            {
                // passo complemento 6 passo 35:
                pagina: 'consultar_equipamento.php',
                elemento: 'a[onclick*="CarregarDescarteInfo"], .btn-secondary[data-target="#modal-descarteinfo"]',
                titulo: 'Dados do Descarte',
                descricao: 'Use este botão para visualizar os dados do descarte de um equipamento.',
                posicao: 'right'
            },
            {
                // -------------------- passo 36:
                pagina: 'remover_equipamento.php',
                elemento: '.card-header',
                titulo: 'Remover Equipamentos',
                descricao: 'Aqui você pode remover equipamentos do sistema quando necessário.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 37:
                pagina: 'remover_equipamento.php',
                elemento: 'select[name="setor"], select[id="setor"]',
                titulo: 'Selecionar Setor',
                descricao: 'Aqui você deve selecionar o setor que deseja remover o equipamento.',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 38:
                pagina: 'remover_equipamento.php',
                elemento: 'tbody tr, .list-group-item, .table tbody tr',
                titulo: 'Lista de Equipamentos',
                descricao: 'Aqui aparecerão todos os equipamentos que você selecionou para remoção.',
                posicao: 'bottom'
            },
            {
                // passo complemento 3 passo 39:
                pagina: 'remover_equipamento.php',
                elemento: 'button[name="btn_excluir"], .btn-danger[data-target="#modal-excluir"]',
                titulo: 'Botão Excluir',
                descricao: 'Use este botão para remover um equipamento da lista.',
                posicao: 'right'
            },
            // Seção Usuários
            {
                // -------------------- passo 40:
                pagina: 'novo_usuario.php',
                elemento: '.card-header',
                titulo: 'Novo Usuário',
                descricao: 'Esta tela permite criar um novo usuário no sistema. Aqui você pode preencher informações como nome, tipo de usuário, cargo, setor, empresa, email, telefone, endereço.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 41:
                pagina: 'novo_usuario.php',
                elemento: 'select[name*="tipo"], select[name*="perfil"], select[name*="cargo"]',
                titulo: 'Seleção de Tipo de Usuário',
                descricao: 'Aqui você deve selecionar o tipo de usuário: <strong>Admin</strong> (acesso total), <strong>Funcionário</strong> (acesso limitado) ou <strong>Técnico</strong> (acesso técnico). Esta definição determina as permissões do usuário no sistema.',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 42:
                pagina: 'novo_usuario.php',
                elemento: 'button[name="btn_cadastrar"], .btn-success, button[type="submit"]',
                titulo: 'Botão Cadastrar',
                descricao: 'Depois de preencher todos os campos obrigatórios, pressione este botão para adicionar o usuário ao sistema.',
                posicao: 'right'
            },
            
            {
                // -------------------- passo 43:
                pagina: 'consultar_usuario.php',
                elemento: '.card-header',
                titulo: 'Consultar Usuários',
                descricao: 'Esta tela permite visualizar todos os usuários cadastrados no sistema. Aqui você pode ver informações como nome, tipo de usuário e status.',
                posicao: 'bottom'
            },
            {
                // passo complemento 1 passo 44:
                pagina: 'consultar_usuario.php',
                elemento: 'input[id="nome_filtro"], input[name="nome_filtro"], #nome_filtro',
                titulo: 'Pesquisar por Usuário',
                descricao: 'Aqui você pode pesquisar por usuário pelo nome. A pesquisa é feita automaticamente conforme você digita.',
                posicao: 'bottom'
            },
            {
                // passo complemento 2 passo 45:
                pagina: 'consultar_usuario.php',
                elemento: 'table tbody tr:first-child',
                titulo: 'Lista de Usuários',
                descricao: 'Na lista de usuários você pode ver o <strong>nome</strong>, <strong>tipo de usuário</strong> e <strong>situação</strong> (ativo/inativo) de cada pessoa.',
                posicao: 'bottom'
            },
            {
                // passo complemento 3 passo 46:
                pagina: 'consultar_usuario.php',
                elemento: '.btn-warning, a[onclick*="DetalharUsuario"]',
                titulo: 'Botão Alterar',
                descricao: 'Use este botão para modificar um usuário existente e alterar todos os seus dados.',
                posicao: 'right'
            },
            {
                // passo complemento 4 passo 47:
                pagina: 'consultar_usuario.php',
                elemento: 'table tbody tr td:nth-child(2)',
                titulo: 'Switch de Ativação/Desativação',
                descricao: 'Use este switch para ativar ou desativar um usuário. Quando ativo, o usuário pode acessar o sistema; quando inativo, o acesso é bloqueado.',
                posicao: 'right'
            },
        ];
    }

    iniciarTour() {
        if (this.isActive) return;

        this.isActive = true;

        // Limpar qualquer estado anterior do tour
        sessionStorage.removeItem('tourAtivo');
        sessionStorage.removeItem('tourPassoAtual');

        // Debug detalhado da página atual
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();
        console.log(`🔍 DEBUG INICIAR TOUR:`);
        console.log(`📍 URL completa: ${window.location.href}`);
        console.log(`📍 URL pathname: ${urlAtual}`);
        console.log(`📄 Nome arquivo: ${nomeArquivo}`);

        // Detectar em qual passo iniciar baseado na página atual
        const passoDetectado = this.detectarPassoAtual();
        this.passoAtual = passoDetectado;

        console.log(`🎯 DEBUG: Passo detectado: ${passoDetectado}, Tour iniciado no passo ${this.passoAtual + 1}`);
        
        const passo = this.passos[this.passoAtual];
        if (passo) {
            console.log(`📋 Passo encontrado: ${passo.pagina} - ${passo.titulo}`);
            
            // Verificar se estamos na página correta do passo detectado
            const paginaCorreta = this.verificarPagina(passo.pagina);
            console.log(`🔍 DEBUG: Página correta para o passo detectado? ${paginaCorreta}`);
            
            if (!paginaCorreta) {
                console.log(`⚠️ DEBUG: Página incorreta para o passo detectado - ajustando passo`);
                // Se não estamos na página correta, encontrar o primeiro passo da página atual
                this.passoAtual = this.encontrarPrimeiroPassoDaPagina(nomeArquivo);
                console.log(`🎯 DEBUG: Passo ajustado para: ${this.passoAtual} (Passo ${this.passoAtual + 1})`);
            }
        } else {
            console.log(`❌ ERRO: Passo não encontrado para índice ${this.passoAtual}`);
        }

        this.overlay.style.pointerEvents = 'auto';
        this.mostrarOverlay();
        this.executarPasso();

        // Salvar que o tour foi iniciado
        localStorage.setItem('tourIniciado', 'true');

    }

    detectarPassoAtual() {
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();

        console.log('🔍 DEBUG DETECTAR PASSO:');
        console.log('📍 URL atual:', urlAtual);
        console.log('📄 Nome arquivo:', nomeArquivo);

        // Verificação robusta baseada no nome exato do arquivo
        // IMPORTANTE: Verificar páginas mais específicas PRIMEIRO para evitar conflitos
        
        if (nomeArquivo === 'gerenciar_tipo_equipamento.php') {
            console.log('🎯 DEBUG: Página gerenciar_tipo_equipamento.php detectada - retornando índice 0');
            return 0;
        }

        if (nomeArquivo === 'gerenciar_modelo_equipamento.php') {
            console.log('🎯 DEBUG: Página gerenciar_modelo_equipamento.php detectada - retornando índice 7');
            return 7; // Passo 8: Gerenciar Modelos de Equipamento
        }
        
        if (nomeArquivo === 'equipamento.php') {
            console.log('🎯 DEBUG: Página equipamento.php detectada - retornando índice 12');
            return 12; // Passo 13: Equipamento
        }
        
        if (nomeArquivo === 'gerenciar_setor.php') {
            console.log('🎯 DEBUG: Página gerenciar_setor.php detectada - retornando índice 18');
            return 18; // Passo 19: Gerenciar Setores
        }
        
        if (nomeArquivo === 'alocar_equipamentos.php') {
            console.log('🎯 DEBUG: Página alocar_equipamentos.php detectada - retornando índice 24');
            return 24; // Passo 25: Alocar Equipamentos
        }
        
        if (nomeArquivo === 'consultar_equipamento.php') {
            console.log('🎯 DEBUG: Página consultar_equipamento.php detectada - retornando índice 28');
            return 28; // Passo 29: Consultar Equipamentos
        }
        
        if (nomeArquivo === 'remover_equipamento.php') {
            console.log('🎯 DEBUG: Página remover_equipamento.php detectada - retornando índice 35');
            return 35; // Passo 36: Remover Equipamentos
        }
        
        if (nomeArquivo === 'novo_usuario.php') {
            console.log('🎯 DEBUG: Página novo_usuario.php detectada - retornando índice 39');
            return 39; // Passo 40: Novo Usuário
        }
        
        if (nomeArquivo === 'consultar_usuario.php') {
            console.log('🎯 DEBUG: Página consultar_usuario.php detectada - retornando índice 42');
            return 42; // Passo 43: Consultar Usuários
        }

        // Se não encontrar a página, iniciar do primeiro passo
        console.log('⚠️ DEBUG: Página não reconhecida, iniciando do primeiro passo (índice 0)');
        return 0;
    }

    encontrarPrimeiroPassoDaPagina(nomeArquivo) {
        console.log(`🔍 DEBUG: Procurando primeiro passo da página: ${nomeArquivo}`);
        
        // Procurar o primeiro passo que corresponde à página atual
        for (let i = 0; i < this.passos.length; i++) {
            const passo = this.passos[i];
            if (passo.pagina === nomeArquivo) {
                console.log(`🎯 DEBUG: Primeiro passo encontrado: índice ${i} - ${passo.titulo}`);
                return i;
            }
        }
        
        console.log(`⚠️ DEBUG: Nenhum passo encontrado para a página ${nomeArquivo}, retornando índice 0`);
        return 0;
    }

    mostrarOverlay() {
        // Mostrar overlay e garantir que está visível
        this.overlay.style.display = 'block';
        this.overlay.style.opacity = '1';
    }

    esconderOverlay() {
        // Esconder overlay e remover do DOM para evitar problemas de layout
        this.overlay.style.opacity = '0';
        this.overlay.style.display = 'none';
    }

    esconderTooltip() {
        // Esconder tooltip removendo a classe ativa
        this.tooltip.className = 'tour-tooltip';
        console.log('🔍 DEBUG: Tooltip escondido');
    }

    executarPasso() {
        if (this.passoAtual >= this.passos.length) {
            console.log(`🏁 DEBUG: Tour finalizado - passo ${this.passoAtual} >= ${this.passos.length}`);
            this.finalizarTour();
            return;
        }

        const passo = this.passos[this.passoAtual];
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();

        console.log(`🚀 DEBUG EXECUTAR PASSO:`);
        console.log(`📍 Passo atual (índice): ${this.passoAtual}, Total de passos: ${this.passos.length}`);
        console.log(`📋 Passo: ${passo.pagina} - ${passo.titulo}`);
        console.log(`📍 URL atual: ${urlAtual}`);
        console.log(`📄 Nome arquivo: ${nomeArquivo}`);

        // Verificar se estamos na página correta
        const paginaCorreta = this.verificarPagina(passo.pagina);
        console.log(`🔍 DEBUG: Página correta? ${paginaCorreta} (esperado: ${passo.pagina})`);

        if (!paginaCorreta) {
            console.log(`🔄 DEBUG: Navegando para página: ${passo.pagina}`);
            this.navegarParaPagina(passo.pagina);
            return;
        }

        console.log(`✅ DEBUG: Página correta - destacando elemento: ${passo.elemento}`);
        // Executar imediatamente
        this.destacarElemento(passo);
    }

    verificarPagina(pagina) {
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop(); // Pega apenas o nome do arquivo
        
        console.log(`🔍 DEBUG VERIFICAR PÁGINA:`);
        console.log(`📍 URL atual: ${urlAtual}`);
        console.log(`📄 Nome arquivo: ${nomeArquivo}`);
        console.log(`🎯 Página esperada: ${pagina}`);
        
        // Verificação mais específica - apenas o nome do arquivo deve coincidir exatamente
        const paginaCorreta = nomeArquivo === pagina;
        
        console.log(`✅ Página correta? ${paginaCorreta} (${nomeArquivo} === ${pagina})`);
        
        return paginaCorreta;
    }

    navegarParaPagina(pagina) {
        // Se não estivermos na página correta, navegar para ela
        const urlAtual = window.location.pathname;
        let novaUrl;
        
        console.log(`🔍 DEBUG: URL atual: ${urlAtual}, Página destino: ${pagina}`);
        
        // Lógica especial para equipamento.php
        if (pagina === 'equipamento.php') {
            console.log(`🎯 DEBUG: Navegação especial para equipamento.php`);
            
            // Verificar se já estamos na pasta adm
            if (urlAtual.includes('/adm/')) {
                const baseUrl = urlAtual.substring(0, urlAtual.lastIndexOf('/') + 1);
                novaUrl = baseUrl + 'equipamento.php';
                console.log(`📁 DEBUG: Já em /adm/ - Base URL: ${baseUrl}`);
            } else {
                const urlBase = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
                novaUrl = `${urlBase}/adm/equipamento.php`;
                console.log(`📁 DEBUG: Não em /adm/ - URL Base: ${urlBase}`);
            }
        } else {
            // Lógica normal para outras páginas
            if (urlAtual.includes('/adm/')) {
                const baseUrl = urlAtual.substring(0, urlAtual.lastIndexOf('/') + 1);
                novaUrl = baseUrl + pagina;
                console.log(`📁 DEBUG: Já em /adm/ - Base URL: ${baseUrl}`);
            } else {
                const urlBase = window.location.origin + window.location.pathname.split('/').slice(0, -1).join('/');
                novaUrl = `${urlBase}/adm/${pagina}`;
                console.log(`📁 DEBUG: Não em /adm/ - URL Base: ${urlBase}`);
            }
        }

        console.log(`🌐 DEBUG: Navegando de ${window.location.pathname} para ${novaUrl}`);
        console.log(`📊 DEBUG: Passo atual: ${this.passoAtual + 1}`);

        // Salvar estado do tour antes de navegar
        sessionStorage.setItem('tourAtivo', 'true');
        sessionStorage.setItem('tourPassoAtual', this.passoAtual);

        // Pequeno delay para garantir que o sessionStorage seja salvo
        setTimeout(() => {
            console.log(`🚀 DEBUG: Executando navegação para: ${novaUrl}`);
            window.location.href = novaUrl;
        }, 200);
    }

    destacarElemento(passo) {
        console.log(`🔍 DEBUG: Tentando encontrar elemento: ${passo.elemento}`);
        
        try {
            // Executar imediatamente
            const elemento = document.querySelector(passo.elemento);

            if (!elemento) {
                console.log(`⚠️ DEBUG: Elemento não encontrado, tentando novamente...`);
                // Tentar novamente rapidamente
                setTimeout(() => {
                    const elementoRetry = document.querySelector(passo.elemento);
                    if (!elementoRetry) {
                        console.log(`❌ DEBUG: Elemento ainda não encontrado, pulando passo`);
                        this.proximoPasso();
                        return;
                    }
                    console.log(`✅ DEBUG: Elemento encontrado na segunda tentativa`);
                    this.destacarElementoAuxiliar(elementoRetry, passo);
                }, 200);
                return;
            }

            // Verificar se o elemento está visível e tem conteúdo
            if (this.verificarElementoValido(elemento, passo)) {
                console.log(`✅ DEBUG: Elemento encontrado e válido: ${elemento.tagName}`);
                this.destacarElementoAuxiliar(elemento, passo);
            } else {
                console.log(`⚠️ DEBUG: Elemento encontrado mas não é válido, pulando passo`);
                this.proximoPasso();
            }
        } catch (error) {
            console.error(`❌ DEBUG: Erro ao buscar elemento: ${error.message}`);
            console.log(`🔄 DEBUG: Pulando passo devido ao erro`);
            this.proximoPasso();
        }
    }

    verificarElementoValido(elemento, passo) {
        // Verificar se o elemento está visível
        if (elemento.offsetParent === null) {
            console.log(`⚠️ DEBUG: Elemento não está visível`);
            return false;
        }

        // Verificar se o elemento tem conteúdo (para botões)
        if (elemento.tagName === 'A' || elemento.tagName === 'BUTTON') {
            const texto = elemento.textContent.trim();
            if (!texto) {
                console.log(`⚠️ DEBUG: Botão sem texto`);
                return false;
            }
        }

        // Verificar se é um botão de descarte e se existe na tabela
        if (passo.elemento.includes('CarregarDescarte') || passo.elemento.includes('modal-descarte')) {
            const tabela = document.querySelector('#tableResult tbody');
            if (!tabela || tabela.children.length === 0) {
                console.log(`⚠️ DEBUG: Tabela vazia, botão de descarte não disponível`);
                return false;
            }
            
            // Verificar se há pelo menos um botão de descarte na tabela
            const botoesDescarte = tabela.querySelectorAll('a[onclick*="CarregarDescarte"]');
            if (botoesDescarte.length === 0) {
                console.log(`⚠️ DEBUG: Nenhum botão de descarte encontrado na tabela`);
                return false;
            }
        }

        // Verificar se é um botão de dados do descarte
        if (passo.elemento.includes('CarregarDescarteInfo') || passo.elemento.includes('modal-descarteinfo')) {
            const tabela = document.querySelector('#tableResult tbody');
            if (!tabela || tabela.children.length === 0) {
                console.log(`⚠️ DEBUG: Tabela vazia, botão de dados do descarte não disponível`);
                return false;
            }
            
            // Verificar se há pelo menos um botão de dados do descarte na tabela
            const botoesDescarteInfo = tabela.querySelectorAll('a[onclick*="CarregarDescarteInfo"]');
            if (botoesDescarteInfo.length === 0) {
                console.log(`⚠️ DEBUG: Nenhum botão de dados do descarte encontrado na tabela`);
                return false;
            }
        }

        return true;
    }

    destacarElementoAuxiliar(elemento, passo) {
        // Remover destaque anterior
        this.removerDestaque();

        // Destacar elemento atual
        elemento.classList.add('tour-highlight');

        // Fazer scroll para o elemento se necessário (instantâneo)
        elemento.scrollIntoView({ behavior: 'auto', block: 'center' });

        // Aguardar um pouco para garantir que o scroll foi concluído
        setTimeout(() => {
            console.log(`🎯 DEBUG: Reposicionando tooltip após scroll`);
            
            // Reposicionar tooltip após scroll
            this.posicionarTooltip(elemento, passo);

            // Atualizar conteúdo do tooltip
            this.atualizarTooltip(passo);
            
            // Verificar se o tooltip está visível e bem posicionado
            this.verificarPosicaoTooltip(elemento, passo);
        }, 150);
    }

    posicionarTooltip(elemento, passo) {
        const rect = elemento.getBoundingClientRect();
        const tooltipRect = this.tooltip.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        let top, left, posicao;
        const margin = 15; // Margem mínima entre tooltip e elemento

        console.log(`🎯 DEBUG: Posicionando tooltip - Elemento: ${rect.width}x${rect.height} em (${rect.left}, ${rect.top})`);

        // Usar posição fixa baseada na preferência do passo
        posicao = `tour-tooltip-${passo.posicao}`;

        switch (passo.posicao) {
            case 'top':
                top = rect.top - tooltipRect.height - margin;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                break;
            case 'bottom':
                top = rect.bottom + margin;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                break;
            case 'left':
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.left - tooltipRect.width - margin;
                break;
            case 'right':
                // Posicionamento fixo ao lado direito, centralizado verticalmente
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.right + margin;
                break;
            default:
                top = rect.bottom + margin;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                posicao = 'tour-tooltip-bottom';
        }

        // Ajustar apenas se sair da tela (sem mudar a posição relativa)
        const minLeft = 10;
        const maxLeft = viewportWidth - tooltipRect.width - 10;
        const minTop = 10;
        const maxTop = viewportHeight - tooltipRect.height - 10;

        // Ajustar horizontalmente se necessário
        if (left < minLeft) {
            left = minLeft;
        } else if (left > maxLeft) {
            left = maxLeft;
        }

        // Ajustar verticalmente se necessário
        if (top < minTop) {
            top = minTop;
        } else if (top > maxTop) {
            top = maxTop;
        }

        // Aplicar posição fixa
        this.tooltip.style.position = 'fixed';
        this.tooltip.style.top = top + 'px';
        this.tooltip.style.left = left + 'px';
        this.tooltip.style.zIndex = '10000';

        console.log(`📍 DEBUG: Posição final: ${passo.posicao} em (${left}, ${top})`);
        console.log(`🎯 DEBUG: Elemento center: ${rect.top + rect.height/2}px, Tooltip center: ${top + tooltipRect.height/2}px`);

        // Mostrar tooltip usando classe CSS
        this.tooltip.className = `tour-tooltip tour-tooltip-active ${posicao}`;

        console.log('✅ DEBUG: Tooltip exibido com sucesso');
        console.log('🔍 DEBUG: Classes do tooltip:', this.tooltip.className);
    }

    verificarPosicaoTooltip(elemento, passo) {
        // Verificar se o tooltip está visível e bem posicionado
        const tooltipRect = this.tooltip.getBoundingClientRect();
        const elementoRect = elemento.getBoundingClientRect();
        const viewportWidth = window.innerWidth;
        const viewportHeight = window.innerHeight;

        console.log(`🔍 DEBUG VERIFICAÇÃO POSIÇÃO:`);
        console.log(`📍 Tooltip: ${tooltipRect.width}x${tooltipRect.height} em (${tooltipRect.left}, ${tooltipRect.top})`);
        console.log(`📍 Elemento: ${elementoRect.width}x${elementoRect.height} em (${elementoRect.left}, ${elementoRect.top})`);
        console.log(`📍 Viewport: ${viewportWidth}x${viewportHeight}`);

        // Verificar se o tooltip está fora da tela
        const foraDaTela = (
            tooltipRect.left < 0 || 
            tooltipRect.top < 0 || 
            tooltipRect.right > viewportWidth || 
            tooltipRect.bottom > viewportHeight
        );

        if (foraDaTela) {
            console.log(`⚠️ DEBUG: Tooltip fora da tela, reposicionando...`);
            this.posicionarTooltip(elemento, passo);
        } else {
            console.log(`✅ DEBUG: Tooltip bem posicionado`);
        }

        // Verificar se o tooltip está muito longe do elemento
        const distanciaX = Math.abs(tooltipRect.left - elementoRect.left);
        const distanciaY = Math.abs(tooltipRect.top - elementoRect.top);
        const distanciaMaxima = 500; // pixels

        if (distanciaX > distanciaMaxima || distanciaY > distanciaMaxima) {
            console.log(`⚠️ DEBUG: Tooltip muito longe do elemento (${distanciaX}px, ${distanciaY}px), reposicionando...`);
            this.posicionarTooltip(elemento, passo);
        }
    }

    aguardarCarregamentoPagina() {
        return new Promise((resolve) => {
            if (document.readyState === 'complete') {
                console.log(`✅ DEBUG: Página já carregada`);
                resolve();
            } else {
                console.log(`⏳ DEBUG: Aguardando carregamento da página...`);
                window.addEventListener('load', () => {
                    console.log(`✅ DEBUG: Página carregada completamente`);
                    resolve();
                });
            }
        });
    }

    atualizarTooltip(passo) {
        const titulo = this.tooltip.querySelector('.tour-tooltip-title');
        const descricao = this.tooltip.querySelector('.tour-tooltip-text');
        const progressText = this.tooltip.querySelector('.tour-progress-text');
        const progressFill = this.tooltip.querySelector('.tour-progress-fill');
        const botaoProximo = this.tooltip.querySelector('.tour-proximo');
        const botaoAnterior = this.tooltip.querySelector('.tour-anterior');

        titulo.textContent = passo.titulo;
        descricao.innerHTML = passo.descricao;
        progressText.textContent = `${this.passoAtual + 1} de ${this.passos.length}`;

        const progressPercent = ((this.passoAtual + 1) / this.passos.length) * 100;
        progressFill.style.width = progressPercent + '%';

        // Mostrar/esconder botão anterior
        if (this.passoAtual > 0) {
            botaoAnterior.style.display = 'inline-block';
        } else {
            botaoAnterior.style.display = 'none';
        }

        // Alterar texto do último botão
        if (this.passoAtual === this.passos.length - 1) {
            botaoProximo.textContent = 'Finalizar Tour';
        } else {
            botaoProximo.textContent = 'Próximo';
        }
    }

    proximoPasso() {
        console.log(`⏭️ DEBUG: Avançando do passo ${this.passoAtual} para ${this.passoAtual + 1}`);
        console.log(`📍 DEBUG: URL atual antes do avanço: ${window.location.pathname}`);
        
        this.passoAtual++;
        
        // Log especial para passo 8 (índice 7)
        if (this.passoAtual === 8) {
            console.log(`🎯 DEBUG: Chegou no passo 8 - deve navegar para equipamento.php`);
        }
        
        this.executarPasso();
    }

    passoAnterior() {
        if (this.passoAtual > 0) {
            this.passoAtual--;
            
            console.log(`🔙 DEBUG PASSO ANTERIOR:`);
            console.log(`📍 Passo atual: ${this.passoAtual} (Passo ${this.passoAtual + 1})`);
            
            const passo = this.passos[this.passoAtual];
            if (passo) {
                console.log(`📋 Passo anterior: ${passo.pagina} - ${passo.titulo}`);
                
                // Verificar se estamos na página correta
                const paginaCorreta = this.verificarPagina(passo.pagina);
                console.log(`🔍 DEBUG: Página correta? ${paginaCorreta} (esperado: ${passo.pagina})`);
                
                if (!paginaCorreta) {
                    console.log(`🔄 DEBUG: Navegando para página anterior: ${passo.pagina}`);
                    this.navegarParaPagina(passo.pagina);
                    return;
                }
                
                // Se estamos na página correta, aguardar um pouco para garantir que o DOM está pronto
                setTimeout(() => {
                    console.log(`✅ DEBUG: Executando passo anterior na página correta`);
                    this.executarPasso();
                }, 100);
            } else {
                console.log(`❌ ERRO: Passo anterior não encontrado para índice ${this.passoAtual}`);
            }
        }
    }

    pularTour() {
        this.finalizarTour();
    }

    fecharTour() {
        this.finalizarTour();
    }

    finalizarTour() {
        this.isActive = false;
        this.removerDestaque();
        this.esconderOverlay();
        this.esconderTooltip();

        // Limpar estado do tour
        sessionStorage.removeItem('tourAtivo');
        sessionStorage.removeItem('tourPassoAtual');

        // Salvar que o tour foi concluído
        localStorage.setItem('tourConcluido', 'true');

        // Mostrar mensagem de sucesso
        if (typeof toastr !== 'undefined') {
            toastr.success('🎉 Tour guiado concluído! Você já conhece as principais funcionalidades do sistema. Pode iniciar o tour novamente a qualquer momento usando o botão no topo da página.');
        }

    }

    removerDestaque() {
        document.querySelectorAll('.tour-highlight').forEach(el => {
            el.classList.remove('tour-highlight');
        });
    }

    verificarTourNecessario() {
        // Verificar se estamos na página de login
        const currentPath = window.location.pathname;
        const isLoginPage = currentPath.includes('login.php') || currentPath.includes('acesso');
        
        if (isLoginPage) {
            console.log('🔒 DEBUG: Página de login detectada, não mostrando tour');
            return;
        }

        const tourConcluido = localStorage.getItem('tourConcluido');
        const tourIniciado = localStorage.getItem('tourIniciado');

        // Se o tour não foi concluído, mostrar banner de boas-vindas
        if (!tourConcluido && !tourIniciado) {
            setTimeout(() => {
                this.mostrarBannerBoasVindas();
            }, 500); // Aguardar apenas 0.5 segundos após o carregamento
        }
    }

    mostrarBannerBoasVindas() {
        // Criar banner de boas-vindas
        const banner = document.createElement('div');
        banner.className = 'tour-banner';
        banner.innerHTML = `
            <div class="tour-banner-content">
                <i class="fas fa-hand-wave" style="font-size: 1.2rem;"></i>
                <span>Bem-vindo ao Sistema de Controle de Chamados!</span>
                <button type="button" class="btn btn-success btn-sm" onclick="tourGuiado.iniciarTour(); this.parentElement.parentElement.remove();">
                    <i class="fas fa-play" style="font-size: 0.8rem;"></i> Iniciar Tour
                </button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="this.parentElement.parentElement.remove();">
                    <i class="fas fa-times" style="font-size: 0.8rem;"></i> Encerrar
                </button>
            </div>
        `;

        document.body.appendChild(banner);

        // Remover automaticamente após 15 segundos
        setTimeout(() => {
            if (banner.parentNode) {
                banner.remove();
            }
        }, 15000);
    }
}

// Inicializar o tour quando a página carregar
let tourGuiado;

// Aguardar DOM estar pronto
document.addEventListener('DOMContentLoaded', function () {
    // Verificar se já foi inicializado
    if (window.tourGuiado) {
        return;
    }

    // Inicializar o tour
    tourGuiado = new TourGuiado();
    window.tourGuiado = tourGuiado; // Disponibilizar globalmente

    // Verificar se deve mostrar banner de boas-vindas (apenas se não estiver em tour ativo)
    const tourAtivo = sessionStorage.getItem('tourAtivo');
    if (!tourAtivo) {
        tourGuiado.verificarTourNecessario();
    }

});

// Função global para iniciar tour (pode ser chamada de qualquer lugar)
function iniciarTourGuiado() {
    if (tourGuiado) {
        tourGuiado.iniciarTour();
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função de teste para forçar navegação para equipamento.php
function testarNavegacaoEquipamento() {
    if (tourGuiado) {
        console.log('🧪 DEBUG: Testando navegação para equipamento.php');
        tourGuiado.navegarParaPagina('equipamento.php');
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para forçar passo 8
function forcarPasso8() {
    if (tourGuiado) {
        console.log('🧪 DEBUG: Forçando passo 8');
        tourGuiado.passoAtual = 7; // Passo 8 (índice 7)
        tourGuiado.executarPasso();
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para testar verificação de página
function testarVerificacaoPagina() {
    if (tourGuiado) {
        console.log('🧪 DEBUG: Testando verificação de página');
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();
        
        console.log(`📍 URL atual: ${urlAtual}`);
        console.log(`📄 Nome arquivo: ${nomeArquivo}`);
        console.log(`🎯 Esperado: equipamento.php`);
        console.log(`✅ É equipamento.php? ${nomeArquivo === 'equipamento.php'}`);
        console.log(`🔍 Verificar página: ${tourGuiado.verificarPagina('equipamento.php')}`);
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para debug completo dos passos
function debugPassos() {
    if (tourGuiado) {
        console.log('🧪 DEBUG: Listando todos os passos');
        console.log(`📊 Total de passos: ${tourGuiado.passos.length}`);
        console.log(`📍 Passo atual: ${tourGuiado.passoAtual}`);
        
        tourGuiado.passos.forEach((passo, index) => {
            console.log(`Passo ${index + 1} (índice ${index}): ${passo.pagina} - ${passo.titulo}`);
        });
        
        console.log(`🎯 Passo 8 (índice 7): ${tourGuiado.passos[7]?.pagina} - ${tourGuiado.passos[7]?.titulo}`);
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para testar seletores
function testarSeletor(seletor) {
    console.log(`🧪 DEBUG: Testando seletor: ${seletor}`);
    try {
        const elemento = document.querySelector(seletor);
        if (elemento) {
            console.log(`✅ DEBUG: Elemento encontrado:`, elemento);
            console.log(`📄 DEBUG: Tag: ${elemento.tagName}, Classes: ${elemento.className}`);
        } else {
            console.log(`❌ DEBUG: Elemento não encontrado`);
        }
    } catch (error) {
        console.error(`❌ DEBUG: Erro no seletor: ${error.message}`);
    }
}

// Função para testar posicionamento de tooltip
function testarPosicionamento(seletor, posicao = 'bottom') {
    if (tourGuiado) {
        console.log(`🧪 DEBUG: Testando posicionamento para: ${seletor}`);
        const elemento = document.querySelector(seletor);
        if (elemento) {
            const rect = elemento.getBoundingClientRect();
            console.log(`📐 DEBUG: Elemento - L: ${rect.left}, T: ${rect.top}, W: ${rect.width}, H: ${rect.height}`);
            console.log(`🖥️ DEBUG: Viewport - W: ${window.innerWidth}, H: ${window.innerHeight}`);
            
            // Simular posicionamento
            const mockPasso = { posicao: posicao };
            tourGuiado.posicionarTooltip(elemento, mockPasso);
        } else {
            console.log(`❌ DEBUG: Elemento não encontrado`);
        }
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função específica para testar posicionamento right
function testarPosicaoRight(seletor) {
    console.log(`🧪 DEBUG: Testando posicionamento RIGHT para: ${seletor}`);
    testarPosicionamento(seletor, 'right');
}

// Função para testar posicionamento fixo
function testarPosicionamentoFixo(seletor) {
    if (tourGuiado) {
        console.log(`🧪 DEBUG: Testando posicionamento FIXO para: ${seletor}`);
        const elemento = document.querySelector(seletor);
        if (elemento) {
            const rect = elemento.getBoundingClientRect();
            console.log(`📐 DEBUG: Elemento - L: ${rect.left}, T: ${rect.top}, W: ${rect.width}, H: ${rect.height}`);
            
            // Simular posicionamento fixo
            const mockPasso = { posicao: 'right' };
            tourGuiado.posicionarTooltip(elemento, mockPasso);
            
            // Verificar se está usando position: fixed
            const tooltip = tourGuiado.tooltip;
            const computedStyle = window.getComputedStyle(tooltip);
            console.log(`🔍 DEBUG: Position: ${computedStyle.position}`);
            console.log(`🔍 DEBUG: Top: ${computedStyle.top}, Left: ${computedStyle.left}`);
            console.log(`🔍 DEBUG: Z-index: ${computedStyle.zIndex}`);
        } else {
            console.log(`❌ DEBUG: Elemento não encontrado`);
        }
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para testar todos os passos do equipamento.php
function testarPassosEquipamento() {
    console.log(`🧪 DEBUG: Testando todos os passos do equipamento.php`);
    
    const passosEquipamento = [
        { seletor: 'select[name="tipo"], select[id="tipo"]', nome: 'Tipo de Equipamento' },
        { seletor: 'select[name="modelo"], select[id="modelo"]', nome: 'Modelo de Equipamento' },
        { seletor: 'input[name="identificacao"], input[id="identificacao"]', nome: 'Identificação' },
        { seletor: 'textarea[name="descricao"], textarea[id="descricao"]', nome: 'Observações' },
        { seletor: 'button[name="btn_cadastrar"], .btn-success', nome: 'Botão Cadastrar' }
    ];
    
    passosEquipamento.forEach((passo, index) => {
        console.log(`\n--- Testando ${index + 1}: ${passo.nome} ---`);
        testarPosicionamento(passo.seletor, 'bottom');
    });
}

// Função para testar detecção de página atual
function testarDetecaoPagina() {
    if (tourGuiado) {
        console.log(`🧪 DEBUG: Testando detecção de página atual`);
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();
        
        console.log(`📍 URL atual: ${urlAtual}`);
        console.log(`📄 Nome arquivo: ${nomeArquivo}`);
        
        const passoDetectado = tourGuiado.detectarPassoAtual();
        console.log(`🎯 Passo detectado: ${passoDetectado} (Passo ${passoDetectado + 1})`);
        
        const passo = tourGuiado.passos[passoDetectado];
        if (passo) {
            console.log(`📋 Passo encontrado: ${passo.pagina} - ${passo.titulo}`);
        } else {
            console.log(`❌ Passo não encontrado para índice ${passoDetectado}`);
        }
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para navegar manualmente para uma página específica
function navegarParaPagina(pagina) {
    if (tourGuiado) {
        console.log(`🧪 DEBUG: Navegando manualmente para: ${pagina}`);
        tourGuiado.navegarParaPagina(pagina);
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para testar navegação do tour
function testarNavegacaoTour() {
    if (tourGuiado) {
        console.log(`🧪 DEBUG: Testando navegação do tour`);
        const urlAtual = window.location.pathname;
        const nomeArquivo = urlAtual.split('/').pop();
        
        console.log(`📍 Página atual: ${nomeArquivo}`);
        
        // Testar detecção
        const passoDetectado = tourGuiado.detectarPassoAtual();
        console.log(`🎯 Passo detectado: ${passoDetectado}`);
        
        // Testar primeiro passo da página
        const primeiroPasso = tourGuiado.encontrarPrimeiroPassoDaPagina(nomeArquivo);
        console.log(`🔍 Primeiro passo da página: ${primeiroPasso}`);
        
        // Mostrar próximos passos
        console.log(`\n📋 Próximos 3 passos:`);
        for (let i = 0; i < 3 && (passoDetectado + i) < tourGuiado.passos.length; i++) {
            const passo = tourGuiado.passos[passoDetectado + i];
            console.log(`  ${i + 1}. ${passo.pagina} - ${passo.titulo}`);
        }
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}

// Função para debug completo do tour
function debugTourCompleto() {
    if (tourGuiado) {
        console.log(`🧪 DEBUG COMPLETO DO TOUR:`);
        console.log(`📊 Total de passos: ${tourGuiado.passos.length}`);
        console.log(`📍 Passo atual: ${tourGuiado.passoAtual}`);
        console.log(`🔗 URL atual: ${window.location.href}`);
        console.log(`📄 Nome arquivo: ${window.location.pathname.split('/').pop()}`);
        
        console.log(`\n📋 LISTA DE TODOS OS PASSOS:`);
        tourGuiado.passos.forEach((passo, index) => {
            const ativo = index === tourGuiado.passoAtual ? '👉' : '  ';
            console.log(`${ativo} Passo ${index + 1} (índice ${index}): ${passo.pagina} - ${passo.titulo}`);
        });
        
        console.log(`\n🎯 TESTE DE DETECÇÃO:`);
        const passoDetectado = tourGuiado.detectarPassoAtual();
        console.log(`Passo detectado: ${passoDetectado} (Passo ${passoDetectado + 1})`);
        
        console.log(`\n🔍 TESTE DE VERIFICAÇÃO DE PÁGINA:`);
        const nomeArquivo = window.location.pathname.split('/').pop();
        console.log(`Nome arquivo atual: ${nomeArquivo}`);
        
        // Testar algumas páginas
        const paginasTeste = ['gerenciar_tipo_equipamento.php', 'equipamento.php', 'gerenciar_setor.php'];
        paginasTeste.forEach(pagina => {
            const resultado = tourGuiado.verificarPagina(pagina);
            console.log(`É ${pagina}? ${resultado}`);
        });
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}
