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
        
    }
    public function update(){

    }
    public function delete(){

    }
    //----------------------OTROS METODOS--------------------------
    public function existeCampo($c, $v){
        $q="select * from users where $c=:v";
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