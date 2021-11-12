<?php
session_start();
if(!isset($_POST['id']) || !isset($_SESSION['username'])){
    header("Location:../");
    die();
}

require dirname(__DIR__, 2)."/vendor/autoload.php";
use Posts\Posts;

(new Posts)->delete($_POST['id']);
$_SESSION['mensaje']="Post Borrado con éxito";
header("Location:../users/");

