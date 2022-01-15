<?php

    abstract class Conection{
        private static $con;
        public static function getCon(){
            if(self::$con == null){
                self::$con = new PDO('mysql: host=localhost; dbname=serie_criando_site;', 'root', "");
            }
            return self::$con;
        }
    }

?>