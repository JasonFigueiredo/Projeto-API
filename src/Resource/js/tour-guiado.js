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
        
        if (tourAtivo === 'true' && passoAtual) {
            this.isActive = true;
            this.passoAtual = parseInt(passoAtual);
            this.overlay.style.pointerEvents = 'auto';
            this.mostrarOverlay();
            
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
        this.tooltip.style.cssText = `
            position: absolute;
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            z-index: 10000;
            max-width: 380px;
            min-width: 320px;
            opacity: 0;
            transform: scale(0.8);
            transition: all ${this.config.duracaoAnimacao}ms ease;
            pointer-events: auto;
        `;
        
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
            console.log('Botão de tour adicionado com sucesso');
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
                posicao: 'top'
            }
        ];
    }

    iniciarTour() {
        if (this.isActive) return;
        
        this.isActive = true;
        this.passoAtual = 0;
        this.overlay.style.pointerEvents = 'auto';
        this.mostrarOverlay();
        this.executarPasso();
        
        // Salvar que o tour foi iniciado
        localStorage.setItem('tourIniciado', 'true');
    }

    mostrarOverlay() {
        // Overlay agora é transparente, apenas mantém a estrutura
        this.overlay.style.opacity = '1';
    }

    esconderOverlay() {
        // Overlay agora é transparente, apenas mantém a estrutura
        this.overlay.style.opacity = '0';
    }

    executarPasso() {
        console.log(`Executando passo ${this.passoAtual + 1} de ${this.passos.length}`);
        
        if (this.passoAtual >= this.passos.length) {
            console.log('Tour concluído - finalizando');
            this.finalizarTour();
            return;
        }

        const passo = this.passos[this.passoAtual];
        console.log(`Passo atual: ${passo.titulo} - Página: ${passo.pagina}`);
        
        // Verificar se estamos na página correta
        if (!this.verificarPagina(passo.pagina)) {
            console.log(`Navegando para página: ${passo.pagina}`);
            this.navegarParaPagina(passo.pagina);
            return;
        }

        console.log('Página correta encontrada - destacando elemento');
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
        
        console.log(`Navegando para: ${novaUrl}`);
        
        // Salvar estado do tour antes de navegar
        sessionStorage.setItem('tourAtivo', 'true');
        sessionStorage.setItem('tourPassoAtual', this.passoAtual);
        
        window.location.href = novaUrl;
    }

    destacarElemento(passo) {
        console.log(`Destacando elemento: ${passo.elemento}`);
        
        // Executar imediatamente
        const elemento = document.querySelector(passo.elemento);
        
        if (!elemento) {
            console.warn(`Elemento não encontrado: ${passo.elemento}`);
            console.log('Tentando novamente rapidamente...');
            
            // Tentar novamente rapidamente
            setTimeout(() => {
                const elementoRetry = document.querySelector(passo.elemento);
                if (!elementoRetry) {
                    console.error(`Elemento ainda não encontrado após retry: ${passo.elemento}`);
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
        
        // Adicionar classe de posição
        this.tooltip.className = `tour-tooltip ${posicao}`;
        
        // Mostrar tooltip
        this.tooltip.style.opacity = '1';
        this.tooltip.style.transform = 'scale(1)';
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
        if (confirm('Tem certeza que deseja pular o tour guiado? Você pode iniciá-lo novamente a qualquer momento.')) {
            this.finalizarTour();
        }
    }

    fecharTour() {
        this.finalizarTour();
    }

    finalizarTour() {
        this.isActive = false;
        this.removerDestaque();
        this.esconderOverlay();
        this.tooltip.style.opacity = '0';
        this.tooltip.style.transform = 'scale(0.8)';
        
        // Limpar estado do tour
        sessionStorage.removeItem('tourAtivo');
        sessionStorage.removeItem('tourPassoAtual');
        
        // Salvar que o tour foi concluído
        localStorage.setItem('tourConcluido', 'true');
        
        // Mostrar mensagem de sucesso
        if (typeof toastr !== 'undefined') {
            toastr.success('🎉 Tour guiado concluído! Você já conhece as principais funcionalidades do sistema. Pode iniciar o tour novamente a qualquer momento usando o botão no topo da página.');
        }
        
        console.log('Tour finalizado com sucesso');
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
    
    console.log('Sistema de Tour Guiado inicializado');
});

// Função global para iniciar tour (pode ser chamada de qualquer lugar)
function iniciarTourGuiado() {
    if (tourGuiado) {
        tourGuiado.iniciarTour();
    } else {
        console.error('Tour Guiado não foi inicializado ainda');
    }
}
