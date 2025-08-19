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

// Função para preparar alteração do setor
function AlterarSetor(id, nome) {
  $('#id_alterar').val(id);
  $('#nome_alterar').val(nome);
}

// Função para confirmar alteração do setor
function Alterar() {
  let id = $("#id_alterar").val();
  let nome = $("#nome_alterar").val();

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: "post",
    url: BASE_URL_DATAVIEW("gerenciar_setor_dataview"),
    data: {
      btn_alterar: "ajx",
      id_alterar: id,
      nome_alterar: nome
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarSetores(); // Atualiza a tabela após a alteração
      FecharModal("modal-alterar");
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

