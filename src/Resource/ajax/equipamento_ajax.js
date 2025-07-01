function CarregarTipo() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            carregar_tipos: "ajx",
            tipo_id: $('#tipo_id').val()
        },
        success: function (dados) {
            $("#tipo").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function CarregarModelos() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            carregar_modelos: "ajx",
            modelo_id: $('#modelo_id').val()
        },
        success: function (dados) {
            $("#modelo").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function FiltrarEquipamentos() {

    let idTipo = $("#tipo").val();
    let idModelo = $("#modelo").val();

    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            filtrar_equipamentos: "ajx",
            tipo: idTipo,
            modelo: idModelo,
            status: $("#status").val()
        },
        success: function (dados) {
            $("#tableResult").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}


function GravarEquipamento() {

    if (NotificarCampos(formID)) {

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: 'post', 
            url: BASE_URL_DATAVIEW("equipamento_dataview"),
            data: {
                btn_gravar: $("#id_equipamento").val() == "" ? "cadastrar" : "alterar",
                id: $("#id").val(),
                tipo_id: $("#tipo").val(),
                modelo_id: $("#modelo").val(),
                nome: $("#nome").val(),
                status: $("#status").val()
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(ret);
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}