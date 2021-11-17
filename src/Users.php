<?php
namespace Posts;

use PDOException;
use PDO;
class Users extends Conexion{
    private $id;
    private $username;
    private $email;
    private $password;
    private $img;

    public function __construct()
    {
        parent::__construct();
    }

    //------------------------ CRUD -------------------------------
    public function create(){
        $q="insert into users(username, email, password, img) values(:un, :em, :pa, :im)";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':un'=>$this->username,
                ':em'=>$this->email,
                ':pa'=>$this->password,
                ':im'=>$this->img
            ]);
        }catch(PDOException $ex){
            die("Error al guardar usuario: ".$ex->getMessage());
        }
        parent::$conexion=null;

    }
    public function read(){
        $q="select * from users where username=:u";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':u'=>$this->username
            ]);
        }catch(PDOException $ex){
            die("Error al devolver usuario:".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function update($id){
        $q="update users set username=:un, email=:em, password=:pa, img=:im where id=:i";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':un'=>$this->username,
                ':em'=>$this->email,
                ':pa'=>$this->password,
                ':im'=>$this->img,
                ':i'=>$id
            ]);
        }catch(PDOException $ex){
            die("Error al actualizar usuario: ".$ex->getMessage());
        }
        parent::$conexion=null;
    }
    public function delete(){


    }
    //----------------------OTROS METODOS--------------------------
    public function existeCampo($c, $v){
        if(!isset($this->id)){
        $q="select * from users where $c=:v";
        }else{
        $q="select * from users where $c=:v AND id<>{$this->id}";
        }

        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':v'=>$v
            ]);
        }catch(PDOException $ex){
            die("Error al comprobar campo:".$ex->getMessage());
        }
        parent::$conexion=null;
        return ($stmt->rowCount()!=0);
    }
    public function recuperarImagen($un){
        $q="select img from users where username=:u";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':u'=>$un
            ]);
        }catch(PDOException $ex){
            die("Error al comprobar campo:".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ)->img;
    }
    public function comprobarUsuario($u, $p){
        $q="select * from users where username=:u AND password=:p";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':u'=>$u,
                ':p'=>$p
            ]);
        }catch(PDOException $ex){
            die("Error al comprobar campo:".$ex->getMessage());
        }
        parent::$conexion=null;
        return ($stmt->rowCount()!=0);


    }
    //
    public function getIds(){
        $q="select id from users";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute();
        }catch(PDOException $ex){
            die("Error al devolver ids: ".$ex->getMessage());
        }
        parent::$conexion=null;
        $ids=[];
        while($fila=$stmt->fetch(PDO::FETCH_OBJ)){
            $ids[]=$fila->id;
        }
        return $ids;
        
    }
    public function devolverId($username){
        $q="select id from users where username=:un";
        $stmt=parent::$conexion->prepare($q);
        try{
            $stmt->execute([
                ':un'=>$username
            ]);
        }catch(PDOException $ex){
            die("Error al devolver ids: ".$ex->getMessage());
        }
        parent::$conexion=null;
        return $stmt->fetch(PDO::FETCH_OBJ)->id;

    }

    //-------------------------------------------------------------
    

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the value of img
     *
     * @return  self
     */ 
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }
}