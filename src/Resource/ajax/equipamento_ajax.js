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
            btn_excluir: $('#tela').val() == "tela_remover" ? "remover_equipamento" : "excluir",
            id_equipamento: $("#id_excluir").val(),
        },
        success: function (ret) {
            MostrarMensagem(ret);
            if ($('#tela').val() == "excluir")
                FiltrarEquipamentos();
            else
            CarregarEquipamentosAlocados($("#setor").val());
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

function Descartar(formID) {

    if (NotificarCampos(formID)) {

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: 'post',
            url: BASE_URL_DATAVIEW("equipamento_dataview"),
            data: {
                btn_descarte: "Descarte",
                id_equipamento: $("#id_descarte").val(),
                motivo_descarte: $("#motivo_descarte").val(),
                data_descarte: $("#data_descarte").val(),
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
                FiltrarEquipamentos();
                FecharModal("modal-descarte");
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function CarregarEquipamentosNaoAlocados() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post',
        url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            carregar_equipamentos_nao_alocados: "ajx"
        },
        success: function (dados) {
            $("#equipamento").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function AlocarEquipamento(formID) {
    if (NotificarCampos(formID)) {

        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: 'post',
            url: BASE_URL_DATAVIEW("equipamento_dataview"),
            data: {
                alocar_equipamento: "ajx",
                id_equipamento: $("#equipamento").val(),
                id_setor: $("#setor").val(),
            },
            success: function (ret) {
                MostrarMensagem(ret);
                LimparNotificacoes(formID);
                CarregarEquipamentosNaoAlocados();
            },
            complete: function () {
                RemoverLoad();
            }
        })
    }
}

function CarregarEquipamentosAlocados(idSetor) {
    if (idSetor != "") {
        $.ajax({
            beforeSend: function () {
                Load();
            },
            type: 'post',
            url: BASE_URL_DATAVIEW("equipamento_dataview"),
            data: {
                filtrar_equipamentos_alocados: "ajx",
                id_setor: idSetor
            },
            success: function (dados) {
                $("#tableResult").html(dados);
                $("#divResultado").show();
            },
            complete: function () {
                RemoverLoad();
            }
        })
    } else {
        $("#divResultado").hide();
        $("#tableResult").html("");
    }
}