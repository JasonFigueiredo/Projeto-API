function CarregarTipo() {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            carregar_tipos: "ajx"
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
            carregar_modelos: "ajx"
        },
        success: function (dados) {
            $("#modelo").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}

function FiltrarEquipamentoTipo(id) {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            filtrar_equipamentos: "ajx",
            tipo: $("#tipo").val(),
            modelo: $("#modelo").val(),
            status: $("#status").val()
        },
        success: function (dados) {
            $("#equipamentos").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}
function FiltrarEquipamentoModelo(id) {
    $.ajax({
        beforeSend: function () {
            Load();
        },
        type: 'post', url: BASE_URL_DATAVIEW("equipamento_dataview"),
        data: {
            filtrar_modelos: "ajx",
            tipo: $("#tipo").val()
        },
        success: function (dados) {
            $("#modelo").html(dados);
        },
        complete: function () {
            RemoverLoad();
        }
    })
}