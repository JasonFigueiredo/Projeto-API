function NotificarCampos(formID) {
  let ret = true;

  $("#" + formID + " input, #" + formID + " textarea, #" + formID + " select").each(function () {

    if ($(this).hasClass("obg")) {

      if ($(this).val() == "") {
        ret = false;
        $(this).addClass("is-invalid");

      } else {
        $(this).removeClass("is-invalid").addClass("is-valid");
      }
    }
  });

  if (!ret)
    MostrarMensagem(0);
  return ret;
} 