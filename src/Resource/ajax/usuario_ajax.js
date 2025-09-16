function VerificarEmailDuplicado() {
  var email = $("#email").val();

  if (email && email.trim() !== '') {
    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: "post",
      url: BASE_URL_DATAVIEW('novo_usuario_dataview'),
      data: {
        verificar_email_duplicado: 'ajx',
        email: email
      },
      success: function (dados) {
        var duplicado = dados.trim() === 'true';
        MostrarMensagem(duplicado ? 5 : 4);
        $("#email").addClass(duplicado ? 'is-invalid' : 'is-valid').removeClass(duplicado ? 'is-valid' : 'is-invalid');
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}

function VerificarCPFDuplicado() {
  var cpf = $("#cpf").val().replace(/\D/g, ''); // Remove formatação

  if (cpf && cpf.length === 11) {
    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: "post",
      url: BASE_URL_DATAVIEW('novo_usuario_dataview'),
      data: {
        verificar_cpf_duplicado: 'ajx',
        cpf: cpf
      },
      success: function (dados) {
        var duplicado = dados.trim() === 'true';
        MostrarMensagem(duplicado ? 6 : -11); // 6 = CPF já cadastrado, -11 = CPF válido
        $("#cpf").addClass(duplicado ? 'is-invalid' : 'is-valid').removeClass(duplicado ? 'is-valid' : 'is-invalid');
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}


function CadastrarUsuario(formID) {
  if (NotificarCampos(formID)) {
    let tipo = $("#tipo").val();
    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: "post",
      url: BASE_URL_DATAVIEW('novo_usuario_dataview'),
      data: {
        btn_cadastrar: 'ajx',
        empresa: tipo == 3 ? $("#empresa").val() : '',
        setor: tipo == 2 ? $("#setor").val() : '',
        tipo: tipo,
        nome: $("#nome").val(),
        email: $("#email").val(),
        cpf: $("#cpf").val().replace(/\D/g, ''), // Remove formatação, envia apenas números
        tel: $("#tel").val(),
        cep: $("#cep").val(),
        rua: $("#rua").val(),
        bairro: $("#bairro").val(),
        cidade: $("#cidade").val(),
        estado: $("#estado").val(),
      },
      success: function (ret) {
        MostrarMensagem(ret);
        if (ret == 1) {
          CarregarCamposUsuario();
          LimparCamposUsuario();
        }
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}

function LimparCamposUsuario() {
  // Limpa campos básicos
  $("#nome").val('').removeClass('is-valid is-invalid');
  $("#email").val('').removeClass('is-valid is-invalid');
  $("#cpf").val('').removeClass('is-valid is-invalid');
  $("#tel").val('').removeClass('is-valid is-invalid');

  // Limpa campos de endereço
  $("#cep").val('').removeClass('is-valid is-invalid');
  $("#rua").val('').removeClass('is-valid is-invalid');
  $("#bairro").val('').removeClass('is-valid is-invalid');
  $("#cidade").val('').removeClass('is-valid is-invalid');
  $("#estado").val('').removeClass('is-valid is-invalid');

  // Limpa campos específicos por tipo
  $("#empresa").val('').removeClass('is-valid is-invalid');
  $("#setor").val('').removeClass('is-valid is-invalid');

  // Limpa seleção de tipo
  $("#tipo").val('').trigger('change');
  $("#tipo").val('').removeClass('is-valid is-invalid');

  // Remove mensagens de validação
  $('.toastr').remove();
}

// Debounce simples de atraso de 300ms para atualização a cada letra digitada
var timeoutFiltro;
function FiltrarUsuarioDebounced() {
  clearTimeout(timeoutFiltro);
  timeoutFiltro = setTimeout(FiltrarUsuario, 300);
}
// --------------------------


function FiltrarUsuario() {
  let nome = document.getElementById('nome_filtro').value;
  if (nome && nome.trim() != '') {
    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: 'post',
      url: BASE_URL_DATAVIEW('novo_usuario_dataview'),
      data: {
        filtrar_usuario: 'ajx',
        nome_filtro: nome
      },
      success: function (dados) {
        if(dados == 0) {
          MostrarMensagem(9);
        } else {
        $("#tableResult").fadeOut(200, function() {
          $(this).html(dados).fadeIn(300);
        });
      }
      },
      complete: function () {
        RemoverLoad();
      }
    });
  } else {
    $("#tableResult").fadeOut(200, function() {
      $(this).html("");
    });
  }
}
