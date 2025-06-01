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
