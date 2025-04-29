function BASE_URL_DATAVIEW(dataview) {
  return "../../Resource/dataview/" + dataview + ".php";
}
function LimparNotificacoes(formID) {
  $(
    "#" + formID + " input, #" + formID + " textarea, #" + formID + " select"
  ).each(function () {
    $(this).val("");
    $(this).removeClass("is-invalid").removeClass("is-valid");
  });
}
function NotificarCampos(formID) {
  let ret = true;
  $(
    "#" + formID + " input, #" + formID + " textarea, #" + formID + " select"
  ).each(function () {
    if ($(this).hasClass("obg")) {
      if ($(this).val() == "") {
        ret = false;
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid").addClass("is-valid");
      }
    }
  });

  if (!ret) MostrarMensagem(0);
  return ret;
}

function FecharModal(nome_modal){
  $("#" + nome_modal).modal("hide");
}