function VerificarEmailDuplicado() {
 if (validarEmailCompleto("#email").val()) {
  $.ajax({
   beforeSend: function () {
    Load();
   },
   type: "post",
   url: BASE_URL_DATAVIEW('novo_usuario_dataview'),
   data: {
    verificar_email_duplicado: 'ajx',
    email: $("#email").val()
   },
   success: function (dados) {
    if (ret) {
     MostrarMensagem(-5);
     $("#email").val('');
    }
   },
   complete: function () {
    RemoverLoad();
   }
  });
 }
}