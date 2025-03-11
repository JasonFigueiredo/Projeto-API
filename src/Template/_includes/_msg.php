<?php

if(isset($ret)){
    switch($ret) {
        case 0:
            echo 
            '<script>
            toastr.warning("preencher os campos obrigatórios");
            </script>';
            break;
        case 1: 
            echo 
            '<script>
            toastr.success("Operação realizada com sucesso");
            </script>';
            break;
        case 2:
            echo 
            '<script>
            toastr.info("Registro excluído com sucesso");
            </script>';
            break;
        case 3:
            echo 
            '<script>
            toastr.error("Erro ao tentar realizar a operação");
            </script>';
            break;
    }
}
?>