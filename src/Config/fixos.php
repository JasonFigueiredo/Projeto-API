<?php
    define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/src/');


    // funções de validação
    const CADASTRAR_TIPO_EQUIPAMENTO = "Cadastrar Tipo de Equipamento";
    const ALTERAR_TIPO_EQUIPAMENTO = "Alterar Tipo de Equipamento";
    const EXCLUIR_TIPO_EQUIPAMENTO = "Excluir Tipo de Equipamento";

    const CADASTRAR_MODELO_EQUIPAMENTO = "Cadastrar Modelo de Equipamento";
    const ALTERAR_MODELO_EQUIPAMENTO = "Alterar Modelo de Equipamento";
    const EXCLUIR_MODELO_EQUIPAMENTO = "Excluir Modelo de Equipamento";

    const CADASTRAR_EQUIPAMENTO = "Cadastrar Equipamento";
    const ALTERAR_EQUIPAMENTO = "Alterar Equipamento";
    const EXCLUIR_EQUIPAMENTO = "Excluir Novo Equipamento";

    const SITUACAO_EQUIPAMENTO_ALOCADO = 1;
    const SITUACAO_EQUIPAMENTO_REMOVIDO = 2;
    const SITUACAO_EQUIPAMENTO_MANUTENCAO = 3;

    const SITUACAO_ATIVO = 1;
    const SITUACAO_INATIVO = 0;
    const SITUACAO_DESCARTADO = 0;