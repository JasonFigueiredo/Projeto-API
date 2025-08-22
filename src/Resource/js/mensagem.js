function MostrarMensagem(ret) {

  if (ret == 1) {
    toastr.success("Operação realizada com sucesso");
  }else if (ret == 0) {
    toastr.warning("Preencher os campos obrigatórios");
  }else if (ret == -1) {
    toastr.error("Ocorreu um erro na operação");
  }else if (ret == -2) {
    toastr.success("Endereço encontrado e preenchido automaticamente!");
  }else if (ret == -3) {
    toastr.error("CEP não encontrado. Verifique o código informado.");
  }else if (ret == -4) {
    toastr.warning("Tempo limite excedido. Tente novamente.");
  }else if (ret == -5) {
    toastr.warning("Erro na consulta do CEP. Verifique sua conexão.");
  }else if (ret == -6) {
    toastr.warning("Formato de CEP inválido. Use o formato: 00000-000");
  }
}