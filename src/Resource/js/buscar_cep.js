// validação do campo CEP ------------------------------------

function limpa_formulário_cep() {
  //Limpa valores do formulário de cep.
  document.getElementById('rua').value = ("");
  document.getElementById('bairro').value = ("");
  document.getElementById('cidade').value = ("");
  document.getElementById('estado').value = ("");
}

function formatarCEP(campo) {
  let cep = campo.value.replace(/\D/g, '');
  
  // Aplica máscara e limita a 8 dígitos
  if (cep.length > 5) cep = cep.replace(/^(\d{5})(\d)/, '$1-$2');
  campo.value = cep.slice(0, 9);
  
  // Validação visual simplificada
  campo.classList.toggle('campo-valido', cep.length === 9);
  campo.classList.toggle('campo-invalido', cep.length > 0 && cep.length !== 9);
}

function limpaFormularioCep() {
  ['rua', 'bairro', 'cidade', 'estado'].forEach(id => {
    const el = document.getElementById(id);
    el.value = "";
    el.classList.remove('campo-valido', 'campo-invalido', 'cep-loading');
  });
}

function preencherCamposEndereco(conteudo) {
  const campos = { rua: conteudo.logradouro, bairro: conteudo.bairro, cidade: conteudo.localidade, estado: conteudo.uf };
  
  Object.entries(campos).forEach(([id, valor], i) => {
    setTimeout(() => {
      const el = document.getElementById(id);
      el.value = valor;
      el.className = el.className.replace(/campo-\w+/g, '') + ' campo-valido';
      el.style.cssText = 'background:#e8f5e8;transition:background .3s';
      setTimeout(() => el.style.background = '', 1000);
    }, i * 150);
  });
}

function mostrarLoadingCep() {
  ['rua', 'bairro', 'cidade', 'estado'].forEach(id => {
    const el = document.getElementById(id);
    el.value = "Buscando...";
    el.className = el.className.replace(/campo-\w+/g, '') + ' cep-loading';
  });
}

function removerLoadingCep() {
  ['rua', 'bairro', 'cidade', 'estado'].forEach(id => 
    document.getElementById(id).classList.remove('cep-loading')
  );
}

function habilitarCampos(flag) {
  $("#cidade").prop("disabled", flag);
  $("#estado").prop("disabled", flag);
}

function meuCallback(conteudo) {
  removerLoadingCep();
  
  const cepField = document.getElementById('cep');
  
  if (!("erro" in conteudo)) {
    preencherCamposEndereco(conteudo);
    cepField.className = cepField.className.replace(/campo-\w+/g, '') + ' campo-valido';
    MostrarMensagem(-2); // Sucesso

  } else {
    habilitarCampos(false);//se erro no cep ele desabilita campos
    limpaFormularioCep();
    MostrarMensagem(-3); // Erro
  }
}

function validarFormatoCep(cep) {
  const cepLimpo = cep.replace(/\D/g, '');
  
  return cepLimpo.length === 8 && 
         !/^(\d)\1{7}$/.test(cepLimpo) && 
         cepLimpo !== '00000000';
}

function pesquisacep(valor) {
  const cep = valor.replace(/\D/g, '');

  if (!cep) {
    limpaFormularioCep();
    document.getElementById('cep').classList.remove('campo-valido', 'campo-invalido');
    return;
  }

  if (!validarFormatoCep(cep)) {
    limpaFormularioCep();
    document.getElementById('cep').classList.replace('campo-valido', 'campo-invalido');
    MostrarMensagem(-6);
    return;
  }

  mostrarLoadingCep();

  const script = document.createElement('script');
  const timeout = setTimeout(() => {
    cleanup();
    MostrarMensagem(-4);
  }, 10000);

  function cleanup() {
    clearTimeout(timeout);
    removerLoadingCep();
    if (script.parentNode) script.parentNode.removeChild(script);
  }

  window.meuCallbackWrapper = function(conteudo) {
    cleanup();
    meuCallback(conteudo);
  };

  script.src = `https://viacep.com.br/ws/${cep}/json/?callback=meuCallbackWrapper`;
  script.onerror = () => {
    cleanup();
    limpaFormularioCep();
    MostrarMensagem(-5);
  };

  document.body.appendChild(script);
}

// Inicializar formatação ao carregar a página
$(document).ready(() => $('#cep').on('input', e => formatarCEP(e.target)));
// validação do campo CEP ------------------------------------