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