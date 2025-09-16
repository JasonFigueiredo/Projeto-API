// Sistema de navegação ativa para marcar página atual
$(document).ready(function() {
    // Função para marcar item ativo no menu
    function marcarItemAtivo() {
        // Obter a página atual
        const paginaAtual = window.location.pathname.split('/').pop();
        
        // Remover classe active de todos os links
        $('.nav-link').removeClass('active');
        $('.nav-item').removeClass('menu-open');
        
        // Marcar o link correspondente à página atual
        const linkAtivo = $(`.nav-link[href="${paginaAtual}"]`);
        
        if (linkAtivo.length > 0) {
            linkAtivo.addClass('active');
            
            // Marcar o item pai como ativo e abrir o submenu
            const itemPai = linkAtivo.closest('.nav-treeview').prev('.nav-link');
            if (itemPai.length > 0) {
                itemPai.addClass('active');
                itemPai.closest('.nav-item').addClass('menu-open');
            }
        }
    }
    
    
    
    // Função para marcar item ativo via AJAX
    function marcarItemAtivoAjax(url) {
        const paginaAtual = url.split('/').pop();
        
        // Remover classe active de todos os links
        $('.nav-link').removeClass('active');
        $('.nav-item').removeClass('menu-open');
        
        // Marcar o link correspondente à página atual
        const linkAtivo = $(`.nav-link[href="${paginaAtual}"]`);
        
        if (linkAtivo.length > 0) {
            linkAtivo.addClass('active');
            
            // Marcar o item pai como ativo e abrir o submenu
            const itemPai = linkAtivo.closest('.nav-treeview').prev('.nav-link');
            if (itemPai.length > 0) {
                itemPai.addClass('active');
                itemPai.closest('.nav-item').addClass('menu-open');
            }
        }
    }
    
    // Marcar item ativo ao carregar a página
    marcarItemAtivo();
    
    // Interceptar cliques nos links do menu para navegação suave
    $('.nav-link[href$=".php"]').on('click', function(e) {
        const url = $(this).attr('href');
        const linkText = $(this).find('p').text().trim();
        
        // Marcar item ativo imediatamente
        marcarItemAtivoPorUrl(url);
        
        // Desabilitar navegação AJAX por enquanto - usar navegação normal
        // A marcação visual funcionará normalmente
        // if (deveUsarAjax(url)) {
        //     e.preventDefault();
        //     carregarPaginaAjax(url, linkText);
        // }
    });
    
    // Função para marcar item ativo por URL
    function marcarItemAtivoPorUrl(url) {
        const paginaAtual = url.split('/').pop();
        
        // Remover classe active de todos os links
        $('.nav-link').removeClass('active');
        $('.nav-item').removeClass('menu-open');
        
        // Marcar o link correspondente à página atual
        const linkAtivo = $(`.nav-link[href="${paginaAtual}"]`);
        
        if (linkAtivo.length > 0) {
            linkAtivo.addClass('active');
            
            // Marcar o item pai como ativo e abrir o submenu
            const itemPai = linkAtivo.closest('.nav-treeview').prev('.nav-link');
            if (itemPai.length > 0) {
                itemPai.addClass('active');
                itemPai.closest('.nav-item').addClass('menu-open');
            }
        }
    }
    
    // Função para verificar se deve usar AJAX
    function deveUsarAjax(url) {
        const paginasAjax = [
            'equipamento.php',
            'gerenciar_setor.php',
            'alocar_equipamentos.php',
            'consultar_equipamento.php',
            'gerenciar_tipo_equipamento.php',
            'gerenciar_modelo_equipamento.php',
            'remover_equipamento.php',
            'novo_usuario.php',
            'consultar_usuario.php'
        ];
        
        const nomeArquivo = url.split('/').pop();
        return paginasAjax.includes(nomeArquivo);
    }
    
    // Função para carregar página via AJAX
    function carregarPaginaAjax(url, titulo) {
        // Fazer requisição AJAX
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                // Criar um elemento temporário para processar o HTML
                const $temp = $('<div>').html(data);
                
                // Extrair o conteúdo do content-wrapper
                const $contentWrapper = $temp.find('.content-wrapper');
                
                if ($contentWrapper.length > 0) {
                    // Atualizar o conteúdo
                    $('.content-wrapper').html($contentWrapper.html());
                } else {
                    // Se não encontrar content-wrapper, usar o body
                    const $body = $temp.find('body');
                    if ($body.length > 0) {
                        $('.content-wrapper').html($body.html());
                    } else {
                        $('.content-wrapper').html(data);
                    }
                }
                
                // Re-executar scripts necessários
                reexecutarScripts();
                
                // Atualizar breadcrumb
                atualizarBreadcrumb(titulo);
                
                // Marcar item ativo
                marcarItemAtivoAjax(url);
            },
            error: function() {
                $('.content-wrapper').html(`
                    <div class="alert alert-danger">
                        <h4>Erro ao carregar página</h4>
                        <p>Não foi possível carregar a página. <a href="${url}" class="alert-link">Tentar novamente</a></p>
                    </div>
                `);
            }
        });
    }
    
    // Função para re-executar scripts necessários
    function reexecutarScripts() {
        // Aguardar um pouco para garantir que o DOM foi atualizado
        setTimeout(function() {
            // Re-inicializar DataTables se existir
            if ($.fn.DataTable) {
                $('.table').each(function() {
                    if ($.fn.DataTable.isDataTable(this)) {
                        $(this).DataTable().destroy();
                    }
                });
                
                $('.table').DataTable({
                    "responsive": true,
                    "lengthChange": false,
                    "autoWidth": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
                    }
                });
            }
            
            // Re-inicializar tooltips
            if ($.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
            
            // Re-inicializar modais
            if ($.fn.modal) {
                $('.modal').modal('hide');
            }
            
            // Re-inicializar card widgets
            if ($.fn.cardWidget) {
                $('[data-card-widget="collapse"]').cardWidget('toggle');
            }
            
            // Executar scripts específicos da página se existirem
            if (typeof ConsultarModelo === 'function') {
                ConsultarModelo();
            }
            if (typeof ConsultarSetores === 'function') {
                ConsultarSetores();
            }
            if (typeof ConsultarTipo === 'function') {
                ConsultarTipo();
            }
            if (typeof FiltrarEquipamentos === 'function') {
                FiltrarEquipamentos();
            }
            if (typeof CarregarTipo === 'function') {
                CarregarTipo();
            }
            if (typeof CarregarModelos === 'function') {
                CarregarModelos();
            }
            if (typeof CarregarSetoresParaAlocacao === 'function') {
                CarregarSetoresParaAlocacao();
            }
            if (typeof CarregarEquipamentosNaoAlocados === 'function') {
                CarregarEquipamentosNaoAlocados();
            }
            if (typeof CarregarSetoresParaRemocao === 'function') {
                CarregarSetoresParaRemocao();
            }
        }, 100);
    }
    
    // Função para atualizar breadcrumb
    function atualizarBreadcrumb(titulo) {
        $('.breadcrumb-item.active').text(titulo);
    }
});
