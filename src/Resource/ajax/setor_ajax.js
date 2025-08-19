function CarregarSetores() {
  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: 'POST',
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      consultar_setor: 'ajx'
    },
    success: function (dados) {
      $('#setor').html(dados);
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

function CadastrarSetor(formID) {
  if (NotificarCampos(formID)) {
    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: 'post',
      url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
      data: {
        btn_cadastrar: 'ajx',
        nome_setor: $('#nome_setor').val()
      },
      success: function (ret) {
        MostrarMensagem(ret);
        LimparNotificacoes(formID);
        ConsultarSetores();
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}

function ExcluirSetor(id, nome) {
  $('#id_excluir').val(id);
  $('#nome_excluir').text(nome);
}

function Excluir() {
  let id = $("#id_excluir").val();

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: 'post',
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      btn_excluir: 'ajx',
      id_excluir: id
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarSetores();
      FecharModal('modal-excluir');
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

function ConsultarSetores() {
  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: 'post',
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      consultar_setor: 'ajx'
    },
    success: function (dados) {
      $('#tableResult').html(dados);
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

function AlterarSetor(id, nome) {
  $('#id_alterar').val(id);
  $('#nome_alterar').val(nome);
}

function Alterar() {
  let id = $('#id_alterar').val();
  let nome = $('#nome_alterar').val();

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: 'post',
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      btn_alterar: 'ajx',
      id_alterar: id,
      nome_alterar: nome
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarSetores();
      FecharModal('modal-alterar');
    },
    complete: function () {
      RemoverLoad();
    }
  });
}


