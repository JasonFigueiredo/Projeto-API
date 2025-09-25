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
            
            // Executar imediatamente
            this.executarPasso();
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
                pagina: 'equipamento.php',
                elemento: '.sidebar',
                titulo: 'Menu de Navegação',
                descricao: 'Bem-vindo ao sistema de controle de chamados! Este é o menu principal onde você encontrará todas as funcionalidades organizadas por categorias. Vamos começar explorando a seção de Equipamentos.',
                posicao: 'right'
            },
            {
                pagina: 'equipamento.php',
                elemento: '.card-header',
                titulo: 'Cadastro de Equipamentos',
                descricao: 'Aqui você pode cadastrar novos equipamentos no sistema. Preencha todos os campos obrigatórios como nome, modelo, tipo e localização do equipamento.',
                posicao: 'bottom'
            },
            {
                pagina: 'gerenciar_setor.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Setores',
                descricao: 'Esta tela permite criar e gerenciar os setores da empresa. Os setores são importantes para organizar os equipamentos por departamento ou área de trabalho.',
                posicao: 'bottom'
            },
            {
                pagina: 'alocar_equipamentos.php',
                elemento: '.card-header',
                titulo: 'Alocar Equipamentos',
                descricao: 'Aqui você pode alocar equipamentos para usuários específicos ou setores. Esta funcionalidade ajuda no controle de quem está usando cada equipamento.',
                posicao: 'bottom'
            },
            {
                pagina: 'consultar_equipamento.php',
                elemento: '.card-header',
                titulo: 'Consultar Equipamentos',
                descricao: 'Esta tela permite visualizar todos os equipamentos cadastrados no sistema, com opções de filtro e busca para encontrar equipamentos específicos.',
                posicao: 'bottom'
            },
            {
                pagina: 'gerenciar_tipo_equipamento.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Tipos de Equipamento',
                descricao: 'Aqui você define os tipos de equipamentos (ex: Computador, Impressora, Telefone). Isso ajuda na categorização e organização dos equipamentos.',
                posicao: 'bottom'
            },
            {
                pagina: 'gerenciar_modelo_equipamento.php',
                elemento: '.card-header',
                titulo: 'Gerenciar Modelos de Equipamento',
                descricao: 'Esta tela permite cadastrar e gerenciar os modelos específicos de equipamentos (ex: Dell Optiplex 7090, HP LaserJet Pro).',
                posicao: 'bottom'
            },
            {
                pagina: 'remover_equipamento.php',
                elemento: '.card-header',
                titulo: 'Remover Equipamentos',
                descricao: 'Aqui você pode remover equipamentos do sistema quando necessário. Cuidado: esta ação pode ser irreversível.',
                posicao: 'bottom'
            },
            // Seção Usuários
            {
                pagina: 'novo_usuario.php',
                elemento: '.sidebar',
                titulo: 'Seção de Usuários',
                descricao: 'Agora vamos explorar a seção de Usuários, onde você pode gerenciar as pessoas que têm acesso ao sistema.',
                posicao: 'right'
            },
            {
                pagina: 'novo_usuario.php',
                elemento: 'select[name*="tipo"], select[name*="perfil"], select[name*="cargo"]',
                titulo: 'Seleção de Tipo de Usuário',
                descricao: 'Aqui você deve selecionar o tipo de usuário: <strong>Admin</strong> (acesso total), <strong>Funcionário</strong> (acesso limitado) ou <strong>Técnico</strong> (acesso técnico). Esta definição determina as permissões do usuário no sistema.',
                posicao: 'bottom'
            },
            {
                pagina: 'consultar_usuario.php',
                elemento: '.card-header',
                titulo: 'Consultar Usuários',
                descricao: 'Esta tela permite visualizar todos os usuários cadastrados no sistema. Aqui você pode ver informações como nome, tipo de usuário e status.',
                posicao: 'bottom'
            },
            {
                pagina: 'consultar_usuario.php',
                elemento: 'table tbody tr:first-child',
                titulo: 'Lista de Usuários',
                descricao: 'Na lista de usuários você pode ver o <strong>nome</strong>, <strong>tipo de usuário</strong> e <strong>situação</strong> (ativo/inativo) de cada pessoa. Use os botões de ação para <strong>alterar</strong> informações ou <strong>ativar/desativar</strong> usuários.',
                posicao: 'bottom'
            }
        ];
    }

    iniciarTour() {
        if (this.isActive) return;
        
        this.isActive = true;
        
        // Limpar qualquer estado anterior do tour
        sessionStorage.removeItem('tourAtivo');
        sessionStorage.removeItem('tourPassoAtual');
        
        // Detectar em qual passo iniciar baseado na página atual
        const passoDetectado = this.detectarPassoAtual();
        this.passoAtual = passoDetectado;
        
        console.log(`🎯 DEBUG: Passo detectado: ${passoDetectado}, Tour iniciado no passo ${this.passoAtual + 1}`);
        
        this.overlay.style.pointerEvents = 'auto';
        this.mostrarOverlay();
        this.executarPasso();
        
        // Salvar que o tour foi iniciado
        localStorage.setItem('tourIniciado', 'true');
        
    }

    detectarPassoAtual() {
        const urlAtual = window.location.pathname;
        
        // Debug temporário
        console.log('🔍 DEBUG: URL atual:', urlAtual);
        
        // Casos especiais para páginas com múltiplos passos
        // IMPORTANTE: Verificar páginas mais específicas PRIMEIRO para evitar conflitos
        
        if (urlAtual.includes('consultar_equipamento.php')) {
            // Se estiver na página de consultar equipamento, sempre iniciar do passo 5
            console.log('🎯 DEBUG: Página consultar_equipamento.php detectada - retornando passo 5');
            return 4; // Passo 5: Consultar Equipamentos
        }
        
        if (urlAtual.includes('gerenciar_tipo_equipamento.php')) {
            // Se estiver na página de gerenciar tipo equipamento, sempre iniciar do passo 6
            console.log('🎯 DEBUG: Página gerenciar_tipo_equipamento.php detectada - retornando passo 6');
            return 5; // Passo 6: Gerenciar Tipos de Equipamento
        }
        
        if (urlAtual.includes('gerenciar_modelo_equipamento.php')) {
            // Se estiver na página de gerenciar modelo equipamento, sempre iniciar do passo 7
            console.log('🎯 DEBUG: Página gerenciar_modelo_equipamento.php detectada - retornando passo 7');
            return 6; // Passo 7: Gerenciar Modelos de Equipamento
        }
        
        if (urlAtual.includes('remover_equipamento.php')) {
            // Se estiver na página de remover equipamento, sempre iniciar do passo 8
            console.log('🎯 DEBUG: Página remover_equipamento.php detectada - retornando passo 8');
            return 7; // Passo 8: Remover Equipamentos
        }
        
        if (urlAtual.includes('alocar_equipamentos.php')) {
            // Se estiver na página de alocar equipamentos, sempre iniciar do passo 4
            console.log('🎯 DEBUG: Página alocar_equipamentos.php detectada - retornando passo 4');
            return 3; // Passo 4: Alocar Equipamentos
        }
        
        if (urlAtual.includes('gerenciar_setor.php')) {
            // Se estiver na página de gerenciar setor, sempre iniciar do passo 3
            console.log('🎯 DEBUG: Página gerenciar_setor.php detectada - retornando passo 3');
            return 2; // Passo 3: Gerenciar Setores
        }
        
        if (urlAtual.includes('equipamento.php')) {
            // Se estiver na página de equipamento, verificar qual elemento está mais visível
            console.log('🎯 DEBUG: Página equipamento.php detectada - verificando elementos visíveis');
            const sidebar = document.querySelector('.sidebar');
            const cardHeader = document.querySelector('.card-header');
            
            if (sidebar && cardHeader) {
                // Verificar qual está mais visível na tela
                const sidebarRect = sidebar.getBoundingClientRect();
                const cardRect = cardHeader.getBoundingClientRect();
                
                // Se o card está mais visível (não está fora da tela), iniciar do passo 2
                if (cardRect.top < window.innerHeight && cardRect.bottom > 0) {
                    return 1; // Segundo passo: Cadastro de Equipamentos
                } else {
                    return 0; // Primeiro passo: Menu de Navegação
                }
            } else if (cardHeader) {
                return 1; // Segundo passo: Cadastro de Equipamentos
            } else {
                return 0; // Primeiro passo: Menu de Navegação
            }
        }
        
        if (urlAtual.includes('novo_usuario.php')) {
            // Se estiver na página de novo usuário, verificar qual elemento está mais visível
            const sidebar = document.querySelector('.sidebar');
            const selectTipo = document.querySelector('select[name*="tipo"], select[name*="perfil"], select[name*="cargo"]');
            
            if (sidebar && selectTipo) {
                // Verificar qual está mais visível na tela
                const sidebarRect = sidebar.getBoundingClientRect();
                const selectRect = selectTipo.getBoundingClientRect();
                
                // Se o select está mais visível, iniciar do passo 10
                if (selectRect.top < window.innerHeight && selectRect.bottom > 0) {
                    return 9; // Passo 10: Seleção de Tipo de Usuário
                } else {
                    return 8; // Passo 9: Seção de Usuários
                }
            } else if (selectTipo) {
                return 9; // Passo 10: Seleção de Tipo de Usuário
            } else {
                return 8; // Passo 9: Seção de Usuários
            }
        }
        
        // Debug para verificar se está passando pelos outros casos
        console.log('🔍 DEBUG: Verificando outros casos...');
        
        if (urlAtual.includes('consultar_usuario.php')) {
            // Se estiver na página de consultar usuário, verificar qual elemento está mais visível
            const cardHeader = document.querySelector('.card-header');
            const table = document.querySelector('table tbody tr:first-child');
            
            if (cardHeader && table) {
                // Verificar qual está mais visível na tela
                const cardRect = cardHeader.getBoundingClientRect();
                const tableRect = table.getBoundingClientRect();
                
                // Se a tabela está mais visível, iniciar do passo 12
                if (tableRect.top < window.innerHeight && tableRect.bottom > 0) {
                    return 11; // Passo 12: Lista de Usuários
                } else {
                    return 10; // Passo 11: Consultar Usuários
                }
            } else if (table) {
                return 11; // Passo 12: Lista de Usuários
            } else {
                return 10; // Passo 11: Consultar Usuários
            }
        }
        
        // Para outras páginas, encontrar o passo correspondente
        console.log('🔍 DEBUG: Verificando loop genérico...');
        for (let i = 0; i < this.passos.length; i++) {
            const passo = this.passos[i];
            console.log(`🔍 DEBUG: Verificando passo ${i + 1}: ${passo.pagina}`);
            if (urlAtual.includes(passo.pagina)) {
                console.log(`✅ DEBUG: Página ${passo.pagina} encontrada no passo ${i + 1}`);
                // Verificar se é a primeira ocorrência desta página
                let primeiraOcorrencia = true;
                for (let j = 0; j < i; j++) {
                    if (this.passos[j].pagina === passo.pagina) {
                        primeiraOcorrencia = false;
                        break;
                    }
                }
                if (primeiraOcorrencia) {
                    console.log(`🎯 DEBUG: Retornando passo ${i + 1} (primeira ocorrência)`);
                    return i;
                }
            }
        }
        
        // Se não encontrar correspondência, iniciar do primeiro passo
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
            this.finalizarTour();
            return;
        }

        const passo = this.passos[this.passoAtual];
        
        console.log(`🚀 DEBUG: Executando passo ${this.passoAtual + 1} - Página: ${passo.pagina}`);
        
        // Verificar se estamos na página correta
        if (!this.verificarPagina(passo.pagina)) {
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
        return urlAtual.includes(pagina);
    }

    navegarParaPagina(pagina) {
        // Se não estivermos na página correta, navegar para ela
        const urlBase = window.location.origin + window.location.pathname.split('/').slice(0, -2).join('/');
        const novaUrl = `${urlBase}/adm/${pagina}`;
        
        console.log(`🌐 DEBUG: Navegando de ${window.location.pathname} para ${novaUrl}`);
        console.log(`📊 DEBUG: Passo atual: ${this.passoAtual + 1}`);
        
        // Salvar estado do tour antes de navegar
        sessionStorage.setItem('tourAtivo', 'true');
        sessionStorage.setItem('tourPassoAtual', this.passoAtual);
        
        window.location.href = novaUrl;
    }

    destacarElemento(passo) {
        // Executar imediatamente
        const elemento = document.querySelector(passo.elemento);
        
        if (!elemento) {
            // Tentar novamente rapidamente
            setTimeout(() => {
                const elementoRetry = document.querySelector(passo.elemento);
                if (!elementoRetry) {
                    this.proximoPasso();
                    return;
                }
                this.destacarElementoAuxiliar(elementoRetry, passo);
            }, 200);
            return;
        }

        this.destacarElementoAuxiliar(elemento, passo);
    }

    destacarElementoAuxiliar(elemento, passo) {
        // Remover destaque anterior
        this.removerDestaque();

        // Destacar elemento atual
        elemento.classList.add('tour-highlight');
        
        // Fazer scroll para o elemento se necessário (instantâneo)
        elemento.scrollIntoView({ behavior: 'auto', block: 'center' });
        
        // Executar imediatamente
        // Posicionar tooltip
        this.posicionarTooltip(elemento, passo);
        
        // Atualizar conteúdo do tooltip
        this.atualizarTooltip(passo);
    }

    posicionarTooltip(elemento, passo) {
        const rect = elemento.getBoundingClientRect();
        const tooltipRect = this.tooltip.getBoundingClientRect();
        
        let top, left, posicao;
        
        switch (passo.posicao) {
            case 'top':
                top = rect.top - tooltipRect.height - 20;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                posicao = 'tour-tooltip-top';
                break;
            case 'bottom':
                top = rect.bottom + 20;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                posicao = 'tour-tooltip-bottom';
                break;
            case 'left':
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.left - tooltipRect.width - 20;
                posicao = 'tour-tooltip-left';
                break;
            case 'right':
                top = rect.top + (rect.height / 2) - (tooltipRect.height / 2);
                left = rect.right + 20;
                posicao = 'tour-tooltip-right';
                break;
            default:
                top = rect.bottom + 20;
                left = rect.left + (rect.width / 2) - (tooltipRect.width / 2);
                posicao = 'tour-tooltip-bottom';
        }

        // Ajustar posição se sair da tela
        if (left < 10) left = 10;
        if (left + tooltipRect.width > window.innerWidth - 10) {
            left = window.innerWidth - tooltipRect.width - 10;
        }
        if (top < 10) top = 10;
        if (top + tooltipRect.height > window.innerHeight - 10) {
            top = window.innerHeight - tooltipRect.height - 10;
        }

        this.tooltip.style.top = top + 'px';
        this.tooltip.style.left = left + 'px';
        
        // Debug: Verificar se tooltip existe
        console.log('🔍 DEBUG: Tooltip existe?', !!this.tooltip);
        console.log('🔍 DEBUG: Posição calculada:', { top, left });
        
        // Mostrar tooltip usando classe CSS
        this.tooltip.className = `tour-tooltip tour-tooltip-active ${posicao}`;
        
        console.log('✅ DEBUG: Tooltip exibido com sucesso');
        console.log('🔍 DEBUG: Classes do tooltip:', this.tooltip.className);
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
        this.passoAtual++;
        this.executarPasso();
    }

    passoAnterior() {
        if (this.passoAtual > 0) {
            this.passoAtual--;
            this.executarPasso();
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
                <i class="fas fa-hand-wave"></i>
                <span>Bem-vindo ao Sistema de Controle de Chamados!</span>
                <button type="button" class="btn btn-success btn-sm" onclick="tourGuiado.iniciarTour(); this.parentElement.parentElement.remove();">
                    <i class="fas fa-play"></i> Iniciar Tour
                </button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="this.parentElement.parentElement.remove();">
                    <i class="fas fa-times"></i> Encerrar
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
document.addEventListener('DOMContentLoaded', function() {
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
