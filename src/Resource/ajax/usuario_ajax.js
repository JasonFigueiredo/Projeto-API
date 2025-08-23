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