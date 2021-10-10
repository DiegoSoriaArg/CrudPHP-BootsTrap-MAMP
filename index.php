<?php
include_once 'conexion.php';

//LEER
$sql_leer = 'SELECT * FROM colores';
$gsent = $pdo->prepare($sql_leer);
$gsent->execute();
$resultado = $gsent->fetchAll();

//var_dump($resultado);

//AGREGAR
if($_POST){
    $color = $_POST['color'];
    $descripcion = $_POST['descripcion'];

    $sql_agregar = 'INSERT INTO colores (color,descripcion) VALUES (?,?)';
    $sentencia_agregar = $pdo->prepare($sql_agregar);
    $sentencia_agregar->execute(array($color,$descripcion));

    //cerramos conexion base de datos y sentencia
    $sentencia_agregar = null;
    $pdo = null;
    header('location:index.php');

}

if($_GET){
    $id = $_GET['id'];
    $sql_unico = 'SELECT * FROM colores WHERE id=?';
    $gsent_unico = $pdo->prepare($sql_unico);
    $gsent_unico->execute(array($id));
    $resultado_unico = $gsent_unico->fetch();

    //var_dump($resultado_unico);
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <title>Dios te bendiga por tu atencion!!</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">

                <?php foreach($resultado as $dato): ?>
                <div 
                class="alert alert-<?php echo $dato['color']; ?> text-uppercase" role="alert">
                    <?php echo $dato['color'] ?>
                    -
                    <?php echo $dato['descripcion'] ?>

                    <a href="eliminar.php?id=<?php echo $dato['id']; ?>" class="float-right ml-3">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    
                    <a href="index.php?id=<?php echo $dato['id']; ?>" class="float-right">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                </div>
                <?php endforeach ?>

            </div>


            <div class="col-md-6">

                <?php if(!$_GET): ?>
                <h2>AGREGAR ELEMENTOS</h2>
                    <form method="POST">
                        <input type="text" class="form-control" name="color">
                        <input type="text" class="form-control mt-3"  name="descripcion">
                        <button class="btn btn-primary mt-3">Agregar</button>
                    </form>
                <?php endif ?>

                <?php if($_GET): ?>
                <h2>EDITAR ELEMENTOS</h2>
                    <form method="GET" action="editar.php" >
                        <input type="text" class="form-control" name="color" value="<?php echo $resultado_unico['color'] ?>">
                        <input type="text" class="form-control mt-3"  name="descripcion" value="<?php echo $resultado_unico['descripcion'] ?>">
                        <input type="hidden" name="id" value="<?php echo $resultado_unico['id'] ?>">
                        <button class="btn btn-primary mt-3">Agregar</button>
                    </form>
                <?php endif ?>

            </div>

            
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>

<?php

//cerramos conexion de base de datos y sentencioa
$pdo = null;
$gsent = null;

?>