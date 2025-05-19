function CarregarTipo(){
  $.ajax({
    beforeSend: function (){
      loand():
    },
    type:'post',
    url: BASE_URL_DATAVIEW("equipamento_dataview"),
    data:{
      carregar_tipos:"ajx"
    },
    success: function(dados){
      $("$tipo").hrml(dados);
    },
    complete: function(){
      RemoverLoand();
    }
    )}
}
