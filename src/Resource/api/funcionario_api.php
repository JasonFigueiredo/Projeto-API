<?php

include_once dirname(__DIR__, 3) . '/vendor/autoload.php';

use Src\Resource\api\Classe\FuncionarioEndPoints;

$obj = new FuncionarioEndPoints();

$obj->SetMethod($_SERVER['REQUEST_METHOD']);

if (!$obj->CheckMethod())
   $obj->SendData('METHOD INVÁLIDO', "-1", "ERRO");

$recebido = getallheaders();

$json = isset($recebido['Content-Type']) && $recebido['Content-Type'] == 'application/json' ? true : false;

//Verifica se o pacote de dados do CLIENTE é no formato JSON
if ($json) {
   $dados = file_get_contents('php://input');
   $dados = json_decode($dados, true);
} else {
   $dados = $_POST;
}

if (!isset($dados['endpoint']) || empty($dados['endpoint'])) {
   $obj->SendData('ENDPOINT NÃO INFORMADO', "-1", "ERRO");
}

$obj->SetEndPoint($dados['endpoint']);

if (!$obj->CheckEndPoint($obj->GetEndPoint()))
   $obj->SendData('ENDPOINT INVÁLIDO', "-1", "ERRO");

$obj->AddParameters($dados);

$result = $obj->{$obj->GetEndPoint()}();
$obj->SendData('Resultado', $result, 'SUCESSO');