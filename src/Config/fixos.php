<?php
define('PATH', $_SERVER['DOCUMENT_ROOT'] . '/ControleOS/src/');


// funções de validação
const CADASTRAR_TIPO_EQUIPAMENTO = "Cadastrar Tipo de Equipamento";
const ALTERAR_TIPO_EQUIPAMENTO = "Alterar Tipo de Equipamento";
const EXCLUIR_TIPO_EQUIPAMENTO = "Excluir Tipo de Equipamento";

const ALTERAR_SENHA_USUARIO = "Alterar Senha de Usuário";

const ABRIR_CHAMADO = "Abrir Chamado";
const ATENDER_CHAMADO = "Atender Chamado";
const FINALIZAR_CHAMADO = "Finalizar Chamado";

const CADASTRAR_USUARIO = "Cadastrar Usuário";
const ALTERAR_USUARIO = "Alterar Usuário";
const ALTERAR_STATUS_USUARIO = "Alterar Status de Usuário";

// funções de setor
const CADASTRAR_SETOR = "Cadastrar Setor";
const ALTERAR_SETOR = "Alterar Setor";
const EXCLUIR_SETOR = "Excluir Setor";

// funções de modelo de equipamento
const CADASTRAR_MODELO_EQUIPAMENTO = "Cadastrar Modelo de Equipamento";
const ALTERAR_MODELO_EQUIPAMENTO = "Alterar Modelo de Equipamento";
const EXCLUIR_MODELO_EQUIPAMENTO = "Excluir Modelo de Equipamento";

// funções de equipamento
const CADASTRAR_EQUIPAMENTO = "Cadastrar Equipamento";
const ALTERAR_EQUIPAMENTO = "Alterar Equipamento";
const EXCLUIR_EQUIPAMENTO = "Excluir Novo Equipamento";
const DESCARTAR_EQUIPAMENTO = "Descartar Equipamento";
const ALOCAR_EQUIPAMENTO = "Alocar Equipamento";
const REMOVER_ALOCAR_EQUIPAMENTO = "Remover Alocar Equipamento";

// Flags de situação de equipamento
const SITUACAO_EQUIPAMENTO_ALOCADO = 1;
const SITUACAO_EQUIPAMENTO_REMOVIDO = 2;
const SITUACAO_EQUIPAMENTO_MANUTENCAO = 3;

// Flags de situação de equipamento
const SIT_CHAMADO_AGUARDANDO = 1;
const SIT_CHAMADO_ANDAMENTO = 2;
const SIT_CHAMADO_ENCERRADO = 3;


// Situações de equipamento
const SITUACAO_ATIVO = 1;
const SITUACAO_INATIVO = 0;
const SITUACAO_DESCARTADO = 0;

// tipos de usuario
const USUARIO_ADM = 1;
const USUARIO_FUNCIONARIO = 2;
const USUARIO_TECNICO = 3;

const SECRET = 'SeuTokenSuperSecreto123!@#';
const NAO_AUTORIZADO = 'Usuario nao autorizado a acessar este recurso.';