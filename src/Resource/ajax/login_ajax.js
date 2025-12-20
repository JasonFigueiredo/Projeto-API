// ===== LOGIN API - SISTEMA UNIFICADO =====
const API_URL_LOGIN = "http://localhost:9090/ControleOs/src/Resource/api/funcionario_api.php";
const ENDPOINT_LOGIN = "ValidarLoginAPI";

// Tipos de usuário (correspondem ao banco de dados)
const TIPO_USUARIO_ADM = 1;
const TIPO_USUARIO_FUNCIONARIO = 2;
const TIPO_USUARIO_TECNICO = 3;

// URLs de redirecionamento por perfil
const URL_ADM = "http://localhost:9090/ControleOs/src/View/adm/consultar_usuario.php";
const URL_FUNCIONARIO = "http://localhost:9090/ControleOsFun/src/view/funcionario/chamados.php";
const URL_TECNICO = "http://localhost:9090/ControleOsTec/src/view/tecnico/chamados.php";

// URL de login única
const URL_LOGIN = "http://localhost:9090/ControleOs/src/View/acesso/login.php";

/**
 * Realiza o login unificado (ADM, Funcionário ou Técnico)
 */
async function Logar(formID) {
   if (!NotificarCampos(formID)) return;

   const login = PegarValor("login").replace(/\D/g, ''); // Remove formatação do CPF
   const senha = PegarValor("senha");

   if (login === '' || senha === '') {
      Mensagem('Por favor, preencha todos os campos.', COR_MSG_ATENCAO);
      return;
   }

   const dados = {
      login: login,
      senha: senha,
      endpoint: ENDPOINT_LOGIN
   };

   try {
      Load();
      const response = await fetch(API_URL_LOGIN, {
         method: 'POST',
         headers: {
            'Content-Type': 'application/json'
         },
         body: JSON.stringify(dados)
      });

      if (!response.ok) {
         throw new Error('Erro ao conectar com o servidor.');
      }

      const objdados = await response.json();
      console.log('📦 Resposta login:', objdados);

      // Verifica se retornou token (string)
      if (objdados.status === 'SUCESSO' && typeof objdados.result === 'string' && objdados.result.includes('.')) {
         // Token válido
         const token = objdados.result;
         AddTnk(token);
         setAuthCookie(token);

         // Extrai dados do token
         const tokenData = GetTnkValue();
         console.log('🔑 Dados do token:', tokenData);

         // Armazena nome do usuário
         setNomeLogado(tokenData.nome);

         // Determina URL de redirecionamento baseado no tipo de usuário
         let urlRedirect = '';
         let perfilNome = '';

         switch (parseInt(tokenData.tipo_usuario)) {
            case TIPO_USUARIO_ADM:
               urlRedirect = URL_ADM;
               perfilNome = 'Administrador';
               break;
            case TIPO_USUARIO_FUNCIONARIO:
               urlRedirect = URL_FUNCIONARIO;
               perfilNome = 'Funcionário';
               break;
            case TIPO_USUARIO_TECNICO:
               urlRedirect = URL_TECNICO;
               perfilNome = 'Técnico';
               break;
            default:
               throw new Error('Tipo de usuário inválido.');
         }

         // Mensagem de sucesso
         Mensagem(`Bem-vindo, ${perfilNome}! Redirecionando...`, COR_MSG_SUCESS);

         // Redireciona para a página correta após 1 segundo
         setTimeout(() => {
            window.location.href = urlRedirect;
         }, 1000);
      } else {
         // Login falhou
         let mensagemErro = 'CPF ou senha incorretos.';
         
         if (objdados.result === 0) {
            mensagemErro = 'Por favor, preencha todos os campos.';
         } else if (objdados.result === 1) {
            mensagemErro = 'Usuário não encontrado ou inativo.';
         } else if (objdados.result === 10) {
            mensagemErro = 'CPF ou senha incorretos.';
         }

         Mensagem(mensagemErro, COR_MSG_ERRO);
      }
   } catch (error) {
      console.error('❌ Erro no login:', error);
      Mensagem('Erro ao tentar fazer login. Tente novamente.', COR_MSG_ERRO);
   } finally {
      RemoverLoad();
   }
}

/**
 * Verifica se o usuário está autenticado ao carregar a página
 * Redireciona para login se não autenticado
 */
function VerificarAutenticacao() {
   const token = GetTnk();
   
   if (!token || token === 'null' || token === 'undefined') {
      // Não está autenticado, redireciona para login único
      window.location.href = URL_LOGIN;
      return;
   }

   // Verifica se o token é válido (formato básico)
   const parts = token.split('.');
   if (parts.length !== 3) {
      // Token inválido
      ClearTnk();
      window.location.href = URL_LOGIN;
      return;
   }

   // Token válido, atualiza nome na interface
   try {
      const tokenData = GetTnkValue();
      if (tokenData && tokenData.nome) {
         setNomeLogado(tokenData.nome);
         MostrarNomeLogin();
      }
   } catch (e) {
      console.error('Erro ao processar token:', e);
      ClearTnk();
      window.location.href = URL_LOGIN;
   }
}

/**
 * Função de logout unificada
 * Limpa token e redireciona para login único
 */
function sairSistema() {
   ClearTnk();
   // limpar cookie
   document.cookie = 'user_tkn=; path=/; max-age=0; SameSite=Lax';
   window.location.href = URL_LOGIN;
}

// Executa verificação de autenticação ao carregar páginas protegidas
// (não executa na página de login)
if (!window.location.href.includes('login.php')) {
   document.addEventListener('DOMContentLoaded', VerificarAutenticacao);
}
