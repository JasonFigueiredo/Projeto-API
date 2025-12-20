const COR_MSG_SUCESS = 1;
const COR_MSG_ERRO = -1;
const COR_MSG_AVISO = 2;
const COR_MSG_ATENCAO = 0;

function BASE_URL_DATAVIEW(dataview) {
  return '../../Resource/dataview/' + dataview + '.php';
}

function LimparNotificacoes(formID) {
  $(
    "#" + formID + " input, #" + formID + " textarea, #" + formID + " select"
  ).each(function () {
    $(this).val('');
    $(this).removeClass("is-invalid").removeClass("is-valid");
  });
}

function NotificarCampos(formID) {
  let ret = true;
  $(
    "#" + formID + " input, #" + formID + " textarea, #" + formID + " select"
  ).each(function () {
    if ($(this).hasClass("obg")) {
      // Verifica se o campo está visível (o próprio campo e todos os seus pais devem estar visíveis)
      var isVisible = $(this).is(':visible') &&
        !$(this).closest('[style*="display: none"], [style*="display:none"]').length;

      if (isVisible) {
        if ($(this).val() == "") {
          ret = false;
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid").addClass("is-valid");
        }
      } else {
        // Remove classes de validação de campos ocultos
        $(this).removeClass("is-invalid is-valid");
      }
    }
  });

  if (!ret) MostrarMensagem(0);
  return ret;
}

function FecharModal(nome_modal) {
  $("#" + nome_modal).modal("hide");
}

function FocarCampoTravar(e, next) {
  if (e.keyCode === 13) {
    e.preventDefault(); //Nao irá para o servidor
    $("#" + next).focus();
  }
}

function Load() {
  $(".loader").addClass("is-active");
}

function RemoverLoad() {
  $(".loader").removeClass("is-active");
}

function CarregarCamposUsuario(tipo) {
  // Primeiro esconde todos os campos com animação suave
  $('#divUsuarioFuncionario, #divUsuarioTecnico').fadeOut(300);

  // Aguarda a animação de saída terminar, então mostra os campos apropriados
  setTimeout(() => {
    switch (tipo) {
      case '1': //ADM
        $('#divDadosUsuario').fadeIn(500);
        $('#divDadosEndereco').fadeIn(600);
        $('#btn_cadastrar').fadeIn(400).addClass('animated-button');
        break;

      case '2': //FUNCIONARIO
        CarregarSetoresSelect();
        $('#divDadosUsuario').fadeIn(500);
        $('#divDadosEndereco').fadeIn(600);
        $('#divUsuarioFuncionario').fadeIn(500);
        $('#btn_cadastrar').fadeIn(400).addClass('animated-button');
        break;

      case '3': //TECNICO
        $('#divDadosUsuario').fadeIn(500);
        $('#divDadosEndereco').fadeIn(600);
        $('#divUsuarioTecnico').fadeIn(500);
        $('#btn_cadastrar').fadeIn(400).addClass('animated-button');
        break;

      default: //NENHUM SELECIONADO
        $('#divDadosUsuario').fadeOut(300);
        $('#divDadosEndereco').fadeOut(300);
        $('#btn_cadastrar').fadeOut(200);
        break;
    }
  }, 350);
}

function AplicarEfeitosVisuais() {
  // Adiciona classes de transição aos elementos principais
  $('.form-group').addClass('campo-transicao');

}

// Função para formatar telefone com máscara visual
function formatarTelefone(campo) {
  let telefone = campo.value.replace(/\D/g, '');

  if (telefone.length <= 10) {
    // Formato: (xx) xxxx-xxxx
    telefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
  } else {
    // Formato: (xx) xxxxx-xxxx
    telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
  }

  campo.value = telefone;
}

// Inicializar efeitos quando a página carregar
$(document).ready(function () {
  AplicarEfeitosVisuais();
});

// Função simples para sair do sistema
function sairSistema() {
  ClearTnk();
  window.location.href = 'http://localhost:9090/ControleOs/src/View/acesso/login.php';
}

function SetarCampoValor(id, value) {
  const el = document.getElementById(id);
  if (el) el.value = value ?? '';
}

function PegarValor(id) {
  const el = document.getElementById(id);
  return el ? el.value : '';
}

function setAuthCookie(token) {
  // Define cookie acessível pelo servidor (expira em 1 dia)
  document.cookie = `user_tkn=${token}; path=/; max-age=${60 * 60 * 24}; SameSite=Lax`;
}

// Funções de token JWT
function AddTnk(t) {
  localStorage.setItem('user_tkn', t);
}

function GetTnkValue() {
  const token = GetTnk();
  if (!token) return {};
  const base64Url = token.split('.')[1];
  const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
  const jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function (c) {
    return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
  }).join(''));
  return JSON.parse(jsonPayload);
}

function GetTnk() {
  return localStorage.getItem('user_tkn');
}

function setNomeLogado(nome) {
  localStorage.setItem('nome_logado', nome);
}

function getNomeLogado() {
  return localStorage.getItem('nome_logado');
}

function MostrarNomeLogin() {
  const nome = getNomeLogado();
  const el = document.getElementById('nome_logado');
  if (nome && el) el.innerHTML = nome;
}

function ClearTnk() {
  localStorage.clear();
  sessionStorage.clear();
  document.cookie = 'user_tkn=; path=/; max-age=0; SameSite=Lax';
}

function Sair() {
  ClearTnk();
  window.location.href = 'http://localhost:9090/ControleOs/src/View/acesso/login.php';
}

function Verify() {
  if (localStorage.getItem('user_tkn') === null) {
    window.location.href = 'http://localhost:9090/ControleOs/src/View/acesso/login.php';
  }
}
