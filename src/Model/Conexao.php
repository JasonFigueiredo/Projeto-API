<?php

namespace Src\Model;

define('HOST', 'localhost'); //ip do servidor
define('USER', 'root'); //usuario do banco
define('PASS', null); //senha do banco
define('DB', 'db_controleos'); //nome do banco

class Conexao
{
  private static $Connect;

  private static function Conectar()
  {
    try {
      if (self::$Connect == null):

        $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
        self::$Connect = new \PDO($dsn, USER, PASS, null);
      endif;

    } catch (\PDOException $e) {
      echo $e->getMessage();
    }

    self::$Connect->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    return self::$Connect;
  }

  public static function GravarErroLog($vo)
  {
    $arquivo = PATH . 'Model/logs/log_erro.txt';

    if(!file_exists($arquivo)) {
      $arquivo = fopen($arquivo, 'w');
    }else{
      $arquivo = fopen($arquivo, 'a+');
    }

    $msg = "------------------------------------------------------" . PHP_EOL;
    $msg .= "Data do erro: " . $vo->getDataErro() . PHP_EOL;
    $msg .= "Hora do erro: " . $vo->getHoraErro() . PHP_EOL;
    $msg .= "Codigo do logado: " . $vo->getCodLogado() . PHP_EOL;
    $msg .= "Funcao do erro: " . $vo->getFuncaoErro() . PHP_EOL;
    $msg .= "Erro tecnico: " . $vo->getErroTecnico() . PHP_EOL;
    $msg .= "------------------------------------------------------" . PHP_EOL;

    fwrite($arquivo, $msg);
    fclose($arquivo);
  }

  public static function retornarConexao()
  {
    return self::Conectar();
  }
  
}
