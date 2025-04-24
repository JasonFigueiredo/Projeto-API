function MostrarMensagem(ret) {

  if (ret == 1) {
    toastr.success("Operação realizada com sucesso");
  } else if (ret == 0) {
    toastr.warning("Preencher os campos obrigatórios");
  }
  else if (ret == -1) {
    toastr.error("Ocorreu um erro na operação");
  }
}
//   switch (ret) {
//     case -1:
//       toastr.error("occoreu um erro na operação");
//       break;
//     case 0:
//       toastr.warning("Preencher os campos obrigatórios");
//       break;
//     case 1:
//       toastr.success("Operação realizada com sucesso");
//       break;
//   }
// }
