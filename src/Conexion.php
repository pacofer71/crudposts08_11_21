<?php
namespace Posts;

use PDOException;
use PDO;
class Conexion{
    protected static $conexion;

    public function __construct()
    {
        if(self::$conexion==null){
            self::crearConexion();
        }
    }
    
    private static function crearConexion(){
        //leemos las parametros del archivo de configuracion
        $fichero=dirname(__DIR__, 1)."/.conf";
        $opciones=parse_ini_file($fichero);
        $host=$opciones['host'];
        $usuario=$opciones['user'];
        $pass=$opciones['password'];
        $bbdd=$opciones['bbdd'];
        //creamos el dns
        $dns="mysql:host=$host;dbname=$bbdd;charset=utf8mb4";
        //iniciamos la conexion
        try{
            self::$conexion=new PDO($dns, $usuario, $pass);
            //esto solo si estamos en desarrollo
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $ex){
            die("Error al conectar a crudposts: ".$ex->getMessage());
        }


    }
    
}
//(new Conexion);