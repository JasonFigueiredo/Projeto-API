function Excluir() {

  let id = $("#id_excluir").val();

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: "post",
    url: BASE_URL_DATAVIEW("gerenciar_tipo_equipamento_dataview"),
    data: {
      btn_excluir: "ajx",
      id_excluir: id
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarTipo();
      FecharModal("modal-excluir");
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

function CadastrarTipoEquipamento(formID) {
  if (NotificarCampos(formID)) {
    let nome = $("#tipo").val();

    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: "post",
      url: BASE_URL_DATAVIEW('gerenciar_tipo_equipamento_dataview'),
      data: {
        tipo: nome,
        btn_cadastrar: 'ajx',
      },
      success: function (ret) {
        MostrarMensagem(ret);
        ConsultarTipo();
        LimparNotificacoes(formID);
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}

function ConsultarTipo() {

  $.ajax({
    beforeSend: function () {
      Load();
    },
    type: "post",
    url: BASE_URL_DATAVIEW('gerenciar_tipo_equipamento_dataview'),
    data: {
      consultar_tipo: 'ajx'
    },
    success: function (dados) {
      $("#tableResult").html(dados);
      FecharModal("modal-consultar");
    },
    complete: function () {
      RemoverLoad();
    }
  });
}

function AlterarTipoEquipamento(formID) {
  if (NotificarCampos(formID)) {
    let nome_tipo = $("#tipo_alterar").val();
    let id = $("#id_alterar").val();

    $.ajax({
      beforeSend: function () {
        Load();
      },
      type: "post",
      url: BASE_URL_DATAVIEW("gerenciar_tipo_equipamento_dataview"),
      data: {
        btn_alterar: 'ajx',
        tipo_alterar: nome_tipo,
        id_alterar: id
      },
      success: function (ret) {
        MostrarMensagem(ret);
        ConsultarTipo();
        FecharModal("alterar-tipo");
      },
      complete: function () {
        RemoverLoad();
      }
    });
  }
}