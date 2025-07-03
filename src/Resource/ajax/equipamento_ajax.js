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

function Excluir() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post',
        url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            btn_excluir: 'excluir',
            id_equipamento: $("#id_excluir").val(),
        },
        success: function (ret) {
            MostrarMensagem(ret);
            FiltrarEquipamentos();
            FecharModal("modal-excluir");
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function GravarEquipamento(formID) {

    if (NotificarCampos(formID)) {

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: 'post',
            url: BASE_URL_DATAVIEW("equipamento_dataview"),
            data: {
                btn_gravar: $("#id_equipamento").val() == "" ? "cadastrar" : "alterar",
                identificacao: $("#identificacao").val(),
                tipo: $("#tipo").val(),
                modelo: $("#modelo").val(),
                descricao: $("#descricao").val(),
                id_equipamento: $("#id_equipamento").val(),
            },
            success: function (ret) {
                MostrarMensagem(ret);

                if ($("#id_equipamento").val() == "") {
                    LimparNotificacoes(formID);
                }
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}