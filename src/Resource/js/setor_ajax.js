function CarregarSetores() {
  $.ajax({
    beforeSend: function () {
      Load();
    },

    type: 'POST',
    url: BASE_URL_DATAVIEW('setor_dataview.php'),
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