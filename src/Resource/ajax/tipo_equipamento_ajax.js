function CadastrarTipoEquipamento(formID) {

  if (NotificarCampos(formID)) {

    let nome = $("#tipo").val();

    $.ajax({
      type:"post",
      url: BASE_URL_DATAVIEW("tipo_equipamento_dataview"),
      data:{
        tipo:nome,
        btn_cadastrar:'ajx'
      },
      success:function (ret) {
        if
        

  }


}