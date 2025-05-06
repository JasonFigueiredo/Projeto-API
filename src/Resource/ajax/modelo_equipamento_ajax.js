function Excluir() {

  let id = $("#id_excluir").val();

  $.ajax({
    type: "post",
    url: BASE_URL_DATAVIEW("gerenciar_modelo_equipamento_dataview"),
    data: {
      btn_excluir: "ajx",
      id_excluir: id
    },
    success: function (ret) {
      MostrarMensagem(ret);
      ConsultarModelo();
      FecharModal("modal-excluir");
    }
  });
}

function CadastrarModeloEquipamento(formID) {
  if (NotificarCampos(formID)) {
    let nome_modelo = $("#modelo").val();

    $.ajax({
      type: "post",
      url: BASE_URL_DATAVIEW("gerenciar_modelo_equipamento_dataview"),
      data: {
        tipo: nome_modelo,
        btn_cadastrar: "ajx",
      },
      success: function (ret) {
        MostrarMensagem(ret);
        ConsultarModelo();
        LimparNotificacoes(formID);
      },
    });
  }
}

function ConsultarModelo() {

  $.ajax({
    type: "post",
    url: BASE_URL_DATAVIEW("gerenciar_modelo_equipamento_dataview"),
    data: {
      consultar_modelo: "ajx"
    },
    success: function (dados) {
      $("#tableResult").html(dados);
      alert(dados);
    }
  });
}

function AlterarModeloEquipamento(formID) {
  if (NotificarCampos(formID)) {
    let nome_modelo = $("#modelo_alterar").val();
    let id = $("#id_alterar").val();

    $.ajax({
      type: "post",
      url: BASE_URL_DATAVIEW("gerenciar_modelo_equipamento_dataview"),
      data: {
        btn_alterar: 'ajx',
        modelo_alterar: nome_modelo,
        id_alterar: id
      },
      success: function (ret) {
        MostrarMensagem(ret);
        ConsultarModelo();
        FecharModal("alterar_modelo");
      }
    });
  }
}

