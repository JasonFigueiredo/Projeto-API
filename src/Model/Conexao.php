<?php

namespace Src\Model;

define('HOST', 'localhost'); //ip do servidor
define('USER', 'root'); //usuario do banco
define('PASS', null); //senha do banco
define('DB', 'mydb'); //nome do banco

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
  public static function retornarConexao()
  {
    return self::Conectar();
  }
}
