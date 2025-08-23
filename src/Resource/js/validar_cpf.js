// Função para aplicar máscara de CPF
function formatarCPF(campo) {
  let cpf = campo.value.replace(/\D/g, '');

  if (cpf.length > 11) cpf = cpf.substring(0, 11);

  // Aplica máscara 000.000.000-00
  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
  cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
  cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

  campo.value = cpf;

  // Feedback visual imediato
  const cpfLimpo = cpf.replace(/\D/g, '');
  if (cpfLimpo.length === 11) {
    if (validarCPF(cpfLimpo)) {
      campo.classList.remove('is-invalid');
      campo.classList.add('is-valid');
    } else {
      campo.classList.remove('is-valid');
      campo.classList.add('is-invalid');
    }
  } else {
    campo.classList.remove('is-valid', 'is-invalid');
  }
}

// Validação matemática completa do CPF
function validarCPF(cpf) {
  cpf = cpf.replace(/\D/g, '');

  if (cpf.length !== 11) return false;

  // Bloqueia números iguais (111.111.111-11, etc.)
  if (/^(\d)\1{10}$/.test(cpf)) return false;

  // Lista de CPFs inválidos conhecidos
  const invalidos = ['00000000000', '11111111111', '22222222222', '33333333333',
    '44444444444', '55555555555', '66666666666', '77777777777',
    '88888888888', '99999999999', '12345678901'];

  if (invalidos.includes(cpf)) return false;

  // Validação primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let digito1 = 11 - (soma % 11);
  if (digito1 >= 10) digito1 = 0;

  if (digito1 !== parseInt(cpf.charAt(9))) return false;

  // Validação segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  let digito2 = 11 - (soma % 11);
  if (digito2 >= 10) digito2 = 0;

  return digito2 === parseInt(cpf.charAt(10));
}

// Função para limpar campo CPF inválido
function limparCPFInvalido(campo) {
  setTimeout(() => {
    campo.value = '';
    campo.classList.remove('is-valid', 'is-invalid');
    campo.focus();
  }, 500); // Limpa após 0.5 segundos
}

// Validação completa com mensagens do sistema
function validarCPFCompleto(campo) {
  const cpf = campo.value.replace(/\D/g, '');

  campo.classList.remove('is-valid', 'is-invalid');

  if (cpf.length === 0) return true;

  let codigo = -11; // CPF válido

  if (cpf.length !== 11) {
    codigo = -7; // CPF deve ter 11 dígitos
  } else if (/^(\d)\1{10}$/.test(cpf)) {
    codigo = -8; // Números iguais
  } else if (!validarCPF(cpf)) {
    codigo = -10; // CPF inválido
  }

  if (codigo === -11) {
    campo.classList.add('is-valid');
  } else {
    campo.classList.add('is-invalid');
    limparCPFInvalido(campo); // Limpa campo se inválido
  }

  MostrarMensagem(codigo);
  return codigo === -11;
}

  // Inicializar validação CPF
function inicializarValidacaoCPF(seletor) {
  const campo = document.querySelector(seletor);
  if (!campo) return;

  campo.maxLength = 14;
  campo.placeholder = '000.000.000-00';

  // Events
  campo.oninput = () => formatarCPF(campo);
  campo.onblur = () => validarCPFCompleto(campo);
  campo.onkeydown = (e) => {
    const permitidas = ['Backspace', 'Delete', 'Tab', 'ArrowLeft', 'ArrowRight'];
    if (!permitidas.includes(e.key) && !/[0-9]/.test(e.key)) {
      e.preventDefault();
    }
  };
}

// Integração com sistema do projeto
$(document).ready(function () {
  if (document.getElementById('cpf')) {
    inicializarValidacaoCPF('#cpf');
  }
});