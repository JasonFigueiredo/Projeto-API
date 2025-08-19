function CarregarSetores() {
  $.ajax({
    beforeSend: function () {
      Load();
    },

    type: 'POST',
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      consultar_setor: 'ajx',
    },
    success: function (dados) {
      $('#setor').html(dados);
    },
    complete: function () {
      RemoverLoad();
    },
  });
}

// Função para preparar exclusão do setor
function ExcluirSetor(id, nome) {
  $('#id_excluir').val(id);
  $('#nome_excluir').text(nome);
}

// Função para confirmar exclusão do setor
function Excluir() {
  let id = $("#id_excluir").val();

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: "post",
    url: BASE_URL_DATAVIEW("gerenciar_setor_dataview"),
    data: {
      btn_excluir: "ajx",
      id_excluir: id
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarSetores();
      FecharModal("modal-excluir");
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

// Função para consultar setores via AJAX e atualizar a tabela
function ConsultarSetores() {
  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: "post",
    url: BASE_URL_DATAVIEW('gerenciar_setor_dataview'),
    data: {
      consultar_setor: 'ajx'
    },
    success: function (dados) {
      $("#tableResult").html(dados);
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

