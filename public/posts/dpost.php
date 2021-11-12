<?php
session_start();
if (!isset($_SESSION['username']) || !isset($_GET['id'])) {
    header("Location:../index.php");
}
$username = $_SESSION['username'];
require dirname(__DIR__, 2) . "/vendor/autoload.php";

use Posts\{Users, Posts};

$imagen = (new Users)->recuperarImagen($username);
$datosPost = (new Posts)->devolverPost($_GET['id']);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootStrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Detalle Post</title>





</head>

<body style="background-color:silver">
    <ul class="nav justify-content-end">
        <img src="<?php echo $imagen; ?>" width="34rem" height="34rem" class="mt-1 rounded-circle" />
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $username; ?></a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="eusuario.php"><i class="fas fa-edit"></i> Editar Usuario</a></li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="cerrar.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesion</a></li>
            </ul>
        </li>
    </ul>
    <h5 class="text-center mt-2">Detalle Post (<?php echo $datosPost->id ?>)</b></h5>
    <div class="container mt-2">
        <div class="card mx-auto" style="width: 28rem;">
            <div class="mx-auto">
            <img src="<?php echo $imagen ?>" class="img-thumbnail mt-2" width="100rem" height="100rem">
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $datosPost->titulo ?></h5>
                <p class="card-text"><?php echo $datosPost->body ?></p>
                <p class="card-text">Creado: <b><?php echo $datosPost->created_at?></b></p>
                <p class="card-text">Última Actualización: <b><?php echo $datosPost->updated_at?></b></p>
                <a href="../users/" class="btn btn-primary"><i class="fas fa-backward"></i> Volver</a>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>