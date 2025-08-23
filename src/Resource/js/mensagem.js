function MostrarMensagem(ret) {

  if (ret == 1) {
    toastr.success("Operação realizada com sucesso");
  } else if (ret == 0) {
    toastr.warning("Preencher os campos obrigatórios");
  } else if (ret == -1) {
    toastr.error("Ocorreu um erro na operação");
  } else if (ret == -2) {
    toastr.success("Endereço encontrado e preenchido automaticamente!");
  } else if (ret == -3) {
    toastr.error("CEP não encontrado. Verifique o código informado.");
  } else if (ret == -4) {
    toastr.warning("Tempo limite excedido. Tente novamente.");
  } else if (ret == -5) {
    toastr.warning("Erro na consulta do CEP. Verifique sua conexão.");
  } else if (ret == -6) {
    toastr.warning("Formato de CEP inválido. Use o formato: 00000-000");
  } else if (ret == -7) {
    toastr.error("CPF deve ter 11 dígitos");
  } else if (ret == -8) {
    toastr.error("CPF não pode ter todos os números iguais");
  } else if (ret == -9) {
    toastr.error("CPF com padrão inválido");
  } else if (ret == -10) {
    toastr.error("CPF inválido");
  } else if (ret == -11) {
    toastr.success("CPF válido");
  } else if (ret == 2) {
    toastr.warning("Campo de email é obrigatório");
  } else if (ret == 3) {
    toastr.error("Formato de email inválido");
  } else if (ret == 4) {
    toastr.success("Email válido");
  } else if (ret == 5) {
    toastr.error("Email já cadastrado");
  } else if (ret == 7) {
    toastr.error("Domínio de email não confiável");
  } else if (ret == 8) {
    toastr.info("Verificando e-mail...");
  }
}