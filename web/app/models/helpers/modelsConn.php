<?php

namespace app\models\helpers;
use PDO;
abstract class modelsConn {
    
    public static $Host = DB_HOST;
    public static $User = DB_USER;
    public static $Pass = DB_PASS;
    public static $Dbname = DB_NAME;    
    
    private static $Connect = null;
    
    //Conectar com o banco de dados utilizando o PDO
    private static function Conectar(){
        try{
            if(self::$Connect == null):
                self::$Connect = new PDO('mysql:host=' . self::$Host . ';dbname=' . self::$Dbname, self::$User, self::$Pass);
            endif;
        } catch (Exception $e) {
            echo 'Mensagem: ' . $e->getMessage();
            die;
        }
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Connect;
    }  
    
    protected static function getConn(){
        return self::Conectar();
    }
   
}