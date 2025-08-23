function validarEmailCompleto(campoId) {
  var campoElement = document.getElementById(campoId);
  var email = campoElement.value.trim();

  // Formatação automática: converte para minúsculas
  if (email !== '') {
    var emailMinusculo = email.toLowerCase();
    if (email !== emailMinusculo) {
      campoElement.value = emailMinusculo;
      email = emailMinusculo;
    }
  }

  // Remove classes anteriores
  campoElement.classList.remove('is-valid', 'is-invalid');

  // 1. Verifica se o campo está vazio
  if (email === '') {
    MostrarMensagem(2); // Campo obrigatório
    return false;
  }

  // 2. Valida formato básico do email (mais rigoroso)
  var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
  if (!regex.test(email)) {
    MostrarMensagem(3); // Formato inválido
    campoElement.classList.add('is-invalid');

    // Limpa campo após 1 segundo
    setTimeout(function () {
      campoElement.value = '';
      campoElement.classList.remove('is-invalid');
    }, 1000);
    return false;
  }

  // 3. Verifica se tem domínio válido
  var partes = email.split('@');
  if (partes.length !== 2 || partes[0] === '' || partes[1] === '') {
    MostrarMensagem(3); // Formato inválido
    campoElement.classList.add('is-invalid');

    setTimeout(function () {
      campoElement.value = '';
      campoElement.classList.remove('is-invalid');
    }, 1000);
    return false;
  }

  var dominio = partes[1].toLowerCase();

  // 5. Verifica se o domínio contém apenas números (proibido)
  var parteDominio = dominio.split('.')[0]; // pega a parte antes do primeiro ponto
  if (/^\d+$/.test(parteDominio)) {
    MostrarMensagem(3); // Formato inválido
    campoElement.classList.add('is-invalid');

    setTimeout(function () {
      campoElement.value = '';
      campoElement.classList.remove('is-invalid');
    }, 1000);
    return false;
  }

  // Verifica se o usuário (antes do @) contém apenas números
  if (/^\d+$/.test(partes[0])) {
    MostrarMensagem(3); // Formato inválido
    campoElement.classList.add('is-invalid');

    setTimeout(function () {
      campoElement.value = '';
      campoElement.classList.remove('is-invalid');
    }, 1000);
    return false;
  }

  // 6. Verifica se o domínio tem pelo menos um ponto
  if (!dominio.includes('.') || dominio.startsWith('.') || dominio.endsWith('.')) {
    MostrarMensagem(3); // Formato inválido
    campoElement.classList.add('is-invalid');

    setTimeout(function () {
      campoElement.value = '';
      campoElement.classList.remove('is-invalid');
    }, 1000);
    return false;
  }

  // 7. Lista simplificada - apenas principais provedores de email
  const dominiosConfiaves = [
    // Principais provedores de email internacionais
    'gmail.com', 'hotmail.com', 'yahoo.com', 'outlook.com', 'live.com',
    'icloud.com', 'aol.com', 'protonmail.com', 'zoho.com',

    // Principais provedores brasileiros
    'uol.com.br', 'bol.com.br', 'terra.com.br', 'globo.com', 'ig.com.br',
    'r7.com', 'oi.com.br'
  ];

  // 8. Primeiro verifica se é domínio confiável conhecido
  if (dominiosConfiaves.includes(dominio)) {
    // Email confiável - agora verifica duplicação
    campoElement.classList.add('is-valid');
    if (typeof VerificarEmailDuplicado === 'function') {
      VerificarEmailDuplicado();
    } else {
      MostrarMensagem(4);
    }
    return true;
  }

  // 9. Se não for confiável conhecido, verifica online se o domínio existe
  verificarDominioOnline(dominio, campoElement);
  return false; // Retorna false temporariamente enquanto verifica online
}


async function verificarDominioOnline(dominio, campoElement) {
  try {
    // Mostra estado de carregamento
    campoElement.classList.add('is-loading');
    MostrarMensagem(8); // "Verificando domínio..."

    // 1. Verifica se domínio tem extensões válidas brasileiras ou internacionais
    var extensoesValidas = [
      '.com.br', '.net.br', '.org.br', '.edu.br', '.gov.br', '.mil.br',
      '.com', '.org', '.net', '.edu', '.gov', '.mil', '.info', '.biz',
      '.co.uk', '.org.uk', '.ac.uk', '.gov.uk'
    ];

    var temExtensaoValida = extensoesValidas.some(ext => dominio.endsWith(ext));

    if (!temExtensaoValida) {
      // Extensão não válida
      campoElement.classList.remove('is-loading');
      campoElement.classList.add('is-invalid');
      MostrarMensagem(7); // Domínio não confiável

      setTimeout(function () {
        campoElement.value = '';
        campoElement.classList.remove('is-invalid');
      }, 1000);
      return false;
    }

    // 2. Verifica se o domínio resolve via DNS (usando Google DNS over HTTPS)
    var response = await fetch(`https://dns.google/resolve?name=${dominio}&type=MX`);
    var data = await response.json();

    campoElement.classList.remove('is-loading');

    // Se tem registros MX (email), aceita como válido
    if (data.Answer && data.Answer.length > 0) {
      campoElement.classList.add('is-valid');
      if (typeof VerificarEmailDuplicado === 'function') {
        VerificarEmailDuplicado();
      } else {
        MostrarMensagem(4);
      }
      return true;
    }

    // 3. Se não tem MX, verifica se pelo menos tem registro A (site existe)
    var responseA = await fetch(`https://dns.google/resolve?name=${dominio}&type=A`);
    var dataA = await responseA.json();

    if (dataA.Answer && dataA.Answer.length > 0) {
      // Site existe, aceita email
      campoElement.classList.add('is-valid');
      if (typeof VerificarEmailDuplicado === 'function') {
        VerificarEmailDuplicado();
      } else {
        MostrarMensagem(4);
      }
      return true;
    } else {
      // Domínio não existe
      campoElement.classList.add('is-invalid');
      MostrarMensagem(7); // Domínio não confiável

      setTimeout(function () {
        campoElement.value = '';
        campoElement.classList.remove('is-invalid');
      }, 1000);
      return false;
    }

  } catch (error) {
    // Em caso de erro na verificação online, permite o domínio se tem extensão válida
    campoElement.classList.remove('is-loading');
    console.log('Erro na verificação online:', error);

    var extensoesSeguras = ['.com.br', '.gov.br', '.edu.br', '.org.br', '.mil.br'];
    var temExtensaoSegura = extensoesSeguras.some(ext => dominio.endsWith(ext));

    if (temExtensaoSegura) {
      campoElement.classList.add('is-valid');
      if (typeof VerificarEmailDuplicado === 'function') {
        VerificarEmailDuplicado();
      } else {
        MostrarMensagem(4);
      }
      return true;
    } else {
      campoElement.classList.add('is-invalid');
      MostrarMensagem(7); // Domínio não confiável

      setTimeout(function () {
        campoElement.value = '';
        campoElement.classList.remove('is-invalid');
      }, 1000);
      return false;
    }
  }
}

function formatarEmail(campoId) {
  var campoElement = document.getElementById(campoId);
  var email = campoElement.value;

  // Converte para minúsculas automaticamente
  if (email !== email.toLowerCase()) {
    campoElement.value = email.toLowerCase();
  }
}
