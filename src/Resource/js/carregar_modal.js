function CarregarDescarteInfo(data, nome, motivo) {
  $("#data_descarte_info").val(data);
  $("#nome_descarte_info").html(nome);
  $("#motivo_info").html(motivo);
}
function CarregarDescarte(id, nome) {
  $("#id_descarte").val(id);
  $("#nome_descarte").html(nome);
}
function CarregarExcluir(id, nome) {
 
  $("#id_excluir").val(id);
  $("#nome_excluir").html(nome);
}
  
function CarregarTipoEquipamento(id, nome) {
  $("#id_alterar").val(id);
  $("#tipo_alterar").val(nome);
}

function CarregarModeloEquipamento(id, nome) {
  $("#id_alterar").val(id);
  $("#modelo_alterar").val(nome);
}
