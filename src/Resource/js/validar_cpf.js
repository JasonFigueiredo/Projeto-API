// Função unificada para validação completa de CPF
function CPF(campo, evento) {
  // Configuração inicial do campo
  if (!campo.maxLength) {
    campo.maxLength = 14;
    campo.placeholder = '000.000.000-00';
  }
  
  // Função para obter CPF sem formatação (apenas números)
  function obterCPFLimpo() {
    return campo.value.replace(/\D/g, '');
  }
  
  // Função para garantir que o campo sempre tenha o valor limpo antes de enviar
  function prepararParaEnvio() {
    const cpfLimpo = obterCPFLimpo();
    // Armazena o valor limpo em um atributo data para uso posterior
    campo.setAttribute('data-cpf-limpo', cpfLimpo);
  }

  // Função interna para aplicar máscara
  function aplicarMascara() {
    let cpf = campo.value.replace(/\D/g, '');
    if (cpf.length > 11) cpf = cpf.substring(0, 11);
    
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    
    campo.value = cpf;
  }

  // Função interna para validação matemática
  function validarMatematicamente(cpf) {
    if (cpf.length !== 11) return false;
    if (/^(\d)\1{10}$/.test(cpf)) return false;

    const invalidos = ['00000000000', '11111111111', '22222222222', '33333333333',
      '44444444444', '55555555555', '66666666666', '77777777777',
      '88888888888', '99999999999', '12345678901'];

    if (invalidos.includes(cpf)) return false;

    // Validação primeiro dígito
    let soma = 0;
    for (let i = 0; i < 9; i++) {
      soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let digito1 = 11 - (soma % 11);
    if (digito1 >= 10) digito1 = 0;
    if (digito1 !== parseInt(cpf.charAt(9))) return false;

    // Validação segundo dígito
    soma = 0;
    for (let i = 0; i < 10; i++) {
      soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    let digito2 = 11 - (soma % 11);
    if (digito2 >= 10) digito2 = 0;

    return digito2 === parseInt(cpf.charAt(10));
  }

  // Função interna para limpar campo inválido
  function limparCampo() {
    setTimeout(() => {
      campo.value = '';
      campo.classList.remove('is-valid', 'is-invalid');
      campo.focus();
    }, 500);
  }

  // Controle de eventos
  switch (evento) {
    case 'input':
    case 'paste':
      aplicarMascara();
      break;

    case 'keydown':
      const permitidas = ['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'];
      const teclasCtrl = ['c', 'v', 'x', 'a'];
      
      if (evento.ctrlKey && teclasCtrl.includes(evento.key.toLowerCase())) {
        return;
      }
      
      if (!permitidas.includes(evento.key) && !/[0-9]/.test(evento.key)) {
        evento.preventDefault();
      }
      break;

    case 'blur':
      const cpf = obterCPFLimpo();
      campo.classList.remove('is-valid', 'is-invalid');
      prepararParaEnvio(); // Prepara o valor limpo para envio

      if (cpf.length === 0) return true;

      if (cpf.length !== 11) {
        campo.classList.add('is-invalid');
        limparCampo();
        MostrarMensagem(-7);
        return false;
      } else if (/^(\d)\1{10}$/.test(cpf)) {
        campo.classList.add('is-invalid');
        limparCampo();
        MostrarMensagem(-8);
        return false;
      } else if (!validarMatematicamente(cpf)) {
        campo.classList.add('is-invalid');
        limparCampo();
        MostrarMensagem(-10);
        return false;
      } else {
        campo.classList.add('is-valid');
        if (typeof VerificarCPFDuplicado === 'function') {
          VerificarCPFDuplicado();
        } else {
          MostrarMensagem(-11);
        }
        return true;
      }
      break;
  }
}

// Função para inicializar validação CPF
function inicializarValidacaoCPF(seletor) {
  const campo = document.querySelector(seletor);
  if (!campo) return;

  // Configuração inicial
  campo.maxLength = 14;
  campo.placeholder = '000.000.000-00';

  // Eventos unificados
  campo.oninput = (e) => CPF(campo, 'input');
  campo.onblur = (e) => CPF(campo, 'blur');
  campo.onpaste = (e) => {
    setTimeout(() => CPF(campo, 'paste'), 10);
  };
  campo.onkeydown = (e) => CPF(campo, 'keydown');
}

// Função global para obter CPF limpo (sem formatação)
function obterCPFLimpo(seletor) {
  const campo = document.querySelector(seletor);
  if (!campo) return '';
  return campo.value.replace(/\D/g, '');
}

// Função global para preparar todos os campos CPF antes do envio
function prepararCamposCPF() {
  const camposCPF = document.querySelectorAll('input[id*="cpf"], input[id*="login"]');
  camposCPF.forEach(campo => {
    const cpfLimpo = campo.value.replace(/\D/g, '');
    campo.setAttribute('data-cpf-limpo', cpfLimpo);
  });
}

// Integração com sistema do projeto
$(document).ready(function () {
  if (document.getElementById('cpf')) {
    inicializarValidacaoCPF('#cpf');
  }
  
  // Preparar campos CPF antes de qualquer envio de formulário
  $('form').on('submit', function() {
    prepararCamposCPF();
  });
});