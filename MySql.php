<?php 
class MySql{
    private static $pdo;

    public static function connect(){
        if(is_null(self::$pdo)){
            try{
                //self::$pdo = new PDO('sqlsrv:server=Gabs1405;Database=base2;','','');
                self::$pdo = new PDO('mysql:dbname=crud;host=localhost;port=3332','root','123456');
                //self::$pdo->setAttribute(PDO::ERRMODE_EXCEPTION,PDO::ATTR_ERRMODE);
            }catch(Exception $e){
                die('error ao conectar.');
            }
        }
        return self::$pdo;
    }
}