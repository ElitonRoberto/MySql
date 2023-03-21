<?php

final class Conexao{
    private function_construct(){

    }

    private static function conectar(){
    try{
        if(!(defined('db_user'))){
            define('db_user','root');
        }
        if(!defined('db_host')){
            define('db_host','localhost');
        }
        if(!defined('db_pass')){
            define('db_pass','root');
        }
        if(!defined('db_name')){
            define('db_name','AulaTec');
        }
        if(!defined('db_port')){
            define('db_port','3360');
        }
        $db = new mysqli(db_host, db_user, db_pass, db_name, db_port);
        return $db;
    }catch (mysqli_sql_exception $e){
        echo 'Problemas ao conectar o banco de dados' . 
        $e->getMenssage();
    }
    public static function query($sql){
        return self::conectar()->query($sql);
    }
}
  
}



?>