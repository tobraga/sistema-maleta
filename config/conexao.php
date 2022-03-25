<?php


//Criar as constantes com as credencias de acesso ao banco de dados
define('HOST', '172.22.5.222');
define('USER', 'maletas.sipam');
define('PASS', 'censipam');
define('DBNAME', 'BD_Maletas');
		
        
class Conexao{
    private static $pdo;
    public static function conectar(){
     if(self::$pdo == null){
    try {		
       self::$pdo = new PDO('pgsql:host='.HOST.';dbname='.DBNAME, USER,PASS);
        //self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
        } 
        catch (PDOException $e) {
 echo 'Erro na Canexão'.$e->getMessage();
        }	
  }
    return self::$pdo;
    }
}
		
?>




